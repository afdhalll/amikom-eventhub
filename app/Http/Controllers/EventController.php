<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Halaman Detail Event
     */
    public function show(Event $event)
    {
        $categories = Category::all();

        // Load relasi category, review, dan user pemberi review
        $event->load([
            'category',
            'reviews.user',
        ]);

        return view('event-detail', compact('categories', 'event'));
    }

    /**
     * Halaman Checkout
     */
    public function checkout()
    {
        return view('checkout');
    }
}