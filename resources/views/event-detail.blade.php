@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">

    <!-- ========================= -->
    <!-- POSTER -->
    <!-- ========================= -->

    <div class="lg:col-span-1">

        <div class="sticky top-32">

            <img
                src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                    ? asset('storage/'.$event->poster_path)
                    : 'https://placehold.co/600x800' }}"
                alt="{{ $event->title }}"
                class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white">

            <div class="mt-8 p-6 bg-white rounded-3xl border border-slate-100 shadow-sm">

                <h4 class="font-bold mb-4">
                    Penyelenggara
                </h4>

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center font-bold text-indigo-600">
                        AB
                    </div>

                    <div>

                        <p class="font-bold">
                            ABP Productions
                        </p>

                        <p class="text-xs text-slate-500">
                            Verified Organizer
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ========================= -->
    <!-- DETAIL EVENT -->
    <!-- ========================= -->

    <div class="lg:col-span-2 space-y-12">

        <div>

            <span class="px-4 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">

                {{ $event->category->name }}

            </span>

            <h1 class="text-5xl font-black mt-4">

                {{ $event->title }}

            </h1>

            <div class="flex gap-6 mt-6 text-slate-500">

                <span>

                    📅
                    {{ \Carbon\Carbon::parse($event->date)->format('d M Y H:i') }}

                </span>

                <span>

                    📍 {{ $event->location }}

                </span>

            </div>

        </div>

        <!-- ========================= -->
        <!-- DESKRIPSI -->
        <!-- ========================= -->

        <div>

            <h2 class="text-2xl font-bold mb-4">

                Deskripsi Event

            </h2>

            <p class="text-slate-600 leading-8">

                {{ $event->description }}

            </p>

        </div>

        <!-- ========================= -->
        <!-- HARGA -->
        <!-- ========================= -->

        <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white shadow-xl">

            <div class="flex justify-between items-center flex-wrap gap-8">

                <div>

                    <p class="uppercase tracking-widest text-indigo-200 mb-2">

                        Harga Tiket

                    </p>

                    <h2 class="text-5xl font-black">

                        Rp {{ number_format($event->price,0,',','.') }}

                    </h2>

                    <p class="mt-4">

                        Sisa Tiket :
                        <strong>{{ $event->stock }}</strong>

                    </p>

                </div>

                <div>

                    <a
                        href="{{ url('checkout/'.$event->id) }}"
                        class="bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold hover:scale-105 transition">

                        Pesan Sekarang

                    </a>

                </div>

            </div>

        </div>

        <!-- ========================= -->
        <!-- REVIEW -->
        <!-- ========================= -->

        <div class="bg-white rounded-3xl border border-slate-100 shadow p-8">
        <h2 class="text-2xl font-bold mb-2">
    Rating & Review
</h2>
          <div class="mb-5">

    <span class="text-yellow-500 text-xl">
        ⭐
    </span>

    <span class="font-bold">

        {{ number_format($event->reviews->avg('rating'),1) }}

    </span>

    <span class="text-gray-500">

        ({{ $event->reviews->count() }} Review)

    </span>

</div>

            @auth

            <form action="{{ route('reviews.store',$event->id) }}" method="POST">

                @csrf

                <div class="mb-5">

                    <label class="font-semibold block mb-2">

                        Rating

                    </label>

                    <select
                        name="rating"
                        required
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="">Pilih Rating</option>

                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>

                        <option value="4">⭐⭐⭐⭐ (4)</option>

                        <option value="3">⭐⭐⭐ (3)</option>

                        <option value="2">⭐⭐ (2)</option>

                        <option value="1">⭐ (1)</option>

                    </select>

                </div>

                @if(session('success'))
<div class="mb-5 rounded-xl border border-green-300 bg-green-100 p-4 text-green-700">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-5 rounded-xl border border-red-300 bg-red-100 p-4 text-red-700">
    {{ session('error') }}
</div>
@endif

                <div class="mb-5">

                    <label class="font-semibold block mb-2">

                        Komentar

                    </label>

                    <textarea
                        name="comment"
                        rows="4"
                        required
                        class="w-full border rounded-xl px-4 py-3"
                        placeholder="Tulis pengalamanmu mengikuti event ini..."></textarea>

                </div>

                <button
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700">

                    {{ $event->reviews->where('user_id', auth()->id())->count() ? 'Update Review' : 'Kirim Review' }}

                </button>

            </form>

            @else

                <div class="bg-yellow-100 border border-yellow-300 p-5 rounded-xl">

                    Login menggunakan Google untuk memberikan review.

                </div>

            @endauth

            <hr class="my-8">

           <h3 class="text-xl font-bold mb-6">
    Semua Review ({{ $event->reviews->count() }})
</h3>

            @forelse($event->reviews as $review)

                <div class="border rounded-2xl p-5 mb-5">

                    <div class="flex justify-between">

                        <div class="flex items-center gap-3">

    <img
        src="{{ $review->user->avatar }}"
        alt="Avatar"
        class="w-10 h-10 rounded-full">

    <div>

        <h4 class="font-bold">
            {{ $review->user->name }}
        </h4>

        <p class="text-xs text-gray-500">
            {{ $review->created_at->format('d M Y') }}
        </p>

    </div>

</div>

                        <div class="text-yellow-500 text-lg">

                            {{ str_repeat('⭐',$review->rating) }}

                        </div>

                    </div>

                    <p class="mt-4 text-slate-600">

                        {{ $review->comment }}

                    </p>

                </div>

            @empty

                <p class="text-slate-500">

                    Belum ada review.

                </p>

            @endforelse

        </div>

        <!-- ========================= -->
        <!-- KEBIJAKAN -->
        <!-- ========================= -->

        <div>

            <h2 class="text-2xl font-bold mb-4">

                Kebijakan Tiket

            </h2>

            <ul class="space-y-3 text-slate-600">

                <li>✅ E-Ticket dikirim otomatis setelah pembayaran berhasil.</li>

                <li>✅ Tiket dapat discan saat check-in.</li>

                <li>❌ Tiket yang telah dibeli tidak dapat direfund.</li>

            </ul>

        </div>

    </div>

</main>

@endsection