@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')

<!-- ========================= -->
<!-- HERO SECTION -->
<!-- ========================= -->

<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">

    <div class="flex-1 space-y-8">

        <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">

            #1 Event Platform

        </span>

        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">

            Temukan & Pesan
            <span class="text-indigo-600">
                Tiket Event
            </span>
            Impianmu.

        </h1>

        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">

            Dari konser musik hingga workshop teknologi,
            semua ada di genggamanmu.

        </p>

        <div class="flex gap-4">

            <a href="#events"
               class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg hover:bg-indigo-700 transition">

                Mulai Jelajah

            </a>

        </div>

    </div>

    <!-- Hero Image -->
    <div class="flex-1">

        <img src="{{ asset('assets/concert.png') }}"
             class="rounded-[2rem] shadow-2xl w-full object-cover">

    </div>

</section>

<!-- ========================= -->
<!-- EVENT SECTION -->
<!-- ========================= -->

<section id="events"
         class="max-w-7xl mx-auto px-6 py-20">

    <!-- Header -->
    <div class="flex justify-between items-end mb-12">

        <div>

            <h2 class="text-3xl font-extrabold mb-2">

                Event Terdekat

            </h2>

            <p class="text-slate-500 font-medium">

                Jangan sampai ketinggalan acara seru minggu ini!

            </p>

        </div>

    </div>

    <!-- FILTER -->
    <div id="kategori"
         class="mb-10 flex flex-wrap gap-3 justify-center">

        <!-- Semua -->
        <a href="/"
           class="px-4 py-2 rounded-xl font-semibold transition
           {{ request('category') ? 'bg-gray-200 text-gray-700' : 'bg-indigo-600 text-white' }}">

            Semua Kategori

        </a>

        <!-- Dynamic Category -->
        @foreach($categories as $cat)

            <a href="/?category={{ $cat->slug }}"
               class="px-4 py-2 rounded-xl font-semibold transition
               {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200' }}">

                {{ $cat->name }}

            </a>

        @endforeach

    </div>

    <!-- Event Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- ========================= -->
        <!-- EVENT STATIS -->
        <!-- ========================= -->

        <!-- Card 1 -->
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl overflow-hidden transition">

            <div class="relative aspect-[3/4]">

                <img src="{{ asset('assets/concert.png') }}"
                     class="w-full h-full object-cover">

                <div class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-bold text-indigo-600 rounded">

                    Musik

                </div>

            </div>

            <div class="p-6">

                <h3 class="text-xl font-bold mb-2">

                    Jazz Night 2024

                </h3>

                <p class="text-sm text-gray-500 mb-3">

                    16 November 2024

                </p>

                <div class="flex justify-between items-center">

                    <span class="text-xl font-bold text-indigo-600">

                        Rp 150rb

                    </span>

                    <a href="#"
                       class="text-indigo-600 font-semibold">

                        Detail

                    </a>

                </div>

            </div>

        </div>

        <!-- Card 2 -->
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl overflow-hidden transition">

            <div class="relative aspect-[3/4]">

                <img src="{{ asset('assets/workshop.png') }}"
                     class="w-full h-full object-cover">

                <div class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-bold text-indigo-600 rounded">

                    Technology

                </div>

            </div>

            <div class="p-6">

                <h3 class="text-xl font-bold mb-2">

                    AI & Future

                </h3>

                <p class="text-sm text-gray-500 mb-3">

                    26 October 2024

                </p>

                <div class="flex justify-between items-center">

                    <span class="text-xl font-bold text-indigo-600">

                        Rp 50rb

                    </span>

                    <a href="#"
                       class="text-indigo-600 font-semibold">

                        Detail

                    </a>

                </div>

            </div>

        </div>

        <!-- Card 3 -->
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl overflow-hidden transition">

            <div class="relative aspect-[3/4]">

                <img src="{{ asset('assets/hackathon.png') }}"
                     class="w-full h-full object-cover">

                <div class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-bold text-indigo-600 rounded">

                    Coding

                </div>

            </div>

            <div class="p-6">

                <h3 class="text-xl font-bold mb-2">

                    Hackathon 2024

                </h3>

                <p class="text-sm text-gray-500 mb-3">

                    18-20 October 2024

                </p>

                <div class="flex justify-between items-center">

                    <span class="text-xl font-bold text-indigo-600">

                        Gratis

                    </span>

                    <a href="#"
                       class="text-indigo-600 font-semibold">

                        Detail

                    </a>

                </div>

            </div>

        </div>

        <!-- ========================= -->
        <!-- EVENT DINAMIS -->
        <!-- ========================= -->

        @forelse($events as $event)

            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl overflow-hidden transition">

                <div class="relative aspect-[3/4]">

                    <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                    ? asset('storage/' . $event->poster_path)
                    : 'https://placehold.co/600x800' }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover">

                    <div class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-bold text-indigo-600 rounded">

                        {{ $event->category->name ?? 'Tanpa Kategori' }}

                    </div>

                </div>

                <div class="p-6">

                    <h3 class="text-xl font-bold mb-2">

                        {{ $event->title }}

                    </h3>

                    <p class="text-sm text-gray-500 mb-3">

                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y H:i') }}

                    </p>

                    <div class="flex justify-between items-center">

                        <span class="text-xl font-bold text-indigo-600">

                            Rp {{ number_format($event->price, 0, ',', '.') }}

                        </span>

                        <a href="{{ route('events.show', $event->id) }}"
                        class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                         Lihat Detail
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <p class="col-span-3 text-center text-gray-500 text-lg">

                Tidak ada event tersedia

            </p>

        @endforelse

    </div>

</section>

<!-- ========================= -->
<!-- PARTNER SECTION -->
<!-- ========================= -->

<section id="partner"
         class="max-w-7xl mx-auto px-6 py-20">

    <div class="text-center mb-14">

        <h2 class="text-4xl font-extrabold mb-4">

            Partner Kami

        </h2>

        <p class="text-gray-500">

            Platform dan perusahaan yang telah bekerja sama dengan AmikomEventHub

        </p>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

        @foreach($partners as $partner)

            <div class="bg-white rounded-3xl shadow-md p-6 flex flex-col items-center hover:shadow-2xl transition">

                <img src="{{ $partner->logo_url }}"
                     alt="{{ $partner->name }}"
                     class="w-32 h-32 object-contain mb-4">

                <h3 class="font-bold text-lg text-center">

                    {{ $partner->name }}

                </h3>

            </div>

        @endforeach

    </div>

</section>

@endsection