<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Detail event dinamis
    public function show(Event $event)
    {
        $categories = Category::all();

        return view('event-detail', compact('categories', 'event'));
    }

    // Halaman checkout
    public function checkout()
    {
        return view('checkout');
    }
}