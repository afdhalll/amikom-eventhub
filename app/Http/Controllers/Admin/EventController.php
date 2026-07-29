<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event
     */
    public function index()
    {
        $query = Event::with('category');

        // Admin hanya melihat event organisasinya
        if (Auth::user()->role !== 'superadmin') {
            $query->where('organization_id', Auth::user()->organization_id);
        }

        $events = $query->latest()->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Form tambah event
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.events.create', compact('categories'));
    }

    /**
     * Simpan event baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('events', 'public');
        }

        // Otomatis mengikuti organisasi admin yang login
        $validated['organization_id'] = Auth::user()->organization_id;

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data Event berhasil ditambahkan.');
    }

    /**
     * Detail event
     */
    public function show(Event $event)
    {
        // Admin tidak boleh melihat event organisasi lain
        if (
            Auth::user()->role !== 'superadmin' &&
            $event->organization_id != Auth::user()->organization_id
        ) {
            abort(403);
        }

        return view('admin.events.show', compact('event'));
    }

    /**
     * Form edit event
     */
    public function edit(Event $event)
    {
        // Admin tidak boleh edit event organisasi lain
        if (
            Auth::user()->role !== 'superadmin' &&
            $event->organization_id != Auth::user()->organization_id
        ) {
            abort(403);
        }

        $categories = Category::all();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * Update event
     */
    public function update(Request $request, Event $event)
    {
        // Admin tidak boleh update event organisasi lain
        if (
            Auth::user()->role !== 'superadmin' &&
            $event->organization_id != Auth::user()->organization_id
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('poster')) {

            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $validated['poster_path'] = $request->file('poster')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data Event berhasil diperbarui.');
    }

    /**
     * Hapus event
     */
    public function destroy(Event $event)
    {
        // Admin tidak boleh menghapus event organisasi lain
        if (
            Auth::user()->role !== 'superadmin' &&
            $event->organization_id != Auth::user()->organization_id
        ) {
            abort(403);
        }

        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}