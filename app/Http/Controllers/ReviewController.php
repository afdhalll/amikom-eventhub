<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Simpan atau update review user
     */
    public function store(Request $request, Event $event)
    {
        // Harus login
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // Satu user hanya boleh satu review per event
        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'event_id' => $event->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

    return redirect()->back()->with(
    'success',
    'Review berhasil disimpan. Jika sebelumnya sudah ada, review telah diperbarui.'
);
    }
}