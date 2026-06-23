@extends('layouts.admin')

@section('content')

<div class="p-6">

<!-- Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

    <div>
        <h2 class="text-3xl font-extrabold text-slate-800 flex items-center gap-3">
            🎫 Manajemen Event
        </h2>

        <p class="text-slate-500 mt-2">
            Kelola seluruh event yang tersedia pada platform AmikomEventHub.
        </p>
    </div>

    <a href="{{ route('admin.events.create') }}"
       class="mt-4 md:mt-0 px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
        + Tambah Event
    </a>

</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl font-medium">
        ✅ {{ session('success') }}
    </div>
@endif

<!-- Card Table -->
<div class="bg-white rounded-[2rem] border border-slate-100 shadow-lg overflow-hidden">

    <div class="px-8 py-5 border-b bg-gradient-to-r from-indigo-50 to-white">

        <h3 class="font-bold text-slate-800 text-lg">
            Daftar Event
        </h3>

        <p class="text-sm text-slate-500 mt-1">
           
        </p>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-[11px] tracking-wider">
                    <th class="px-6 py-4 font-bold">Poster</th>
                    <th class="px-6 py-4 font-bold">Judul Event</th>
                    <th class="px-6 py-4 font-bold">Kategori</th>
                    <th class="px-6 py-4 font-bold">Tanggal</th>
                    <th class="px-6 py-4 font-bold">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($events as $event)

                    <tr class="border-b border-slate-100 hover:bg-indigo-50/40 transition-all duration-200">

                        <td class="px-6 py-5">

                            @if($event->poster_path)

                                <img src="{{ asset('storage/' . $event->poster_path) }}"
                                     alt="{{ $event->title }}"
                                     class="w-20 h-20 object-cover rounded-2xl border shadow-sm">

                            @else

                                <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 text-sm">
                                    No Image
                                </div>

                            @endif

                        </td>

                        <td class="px-6 py-5">

                            <h4 class="font-bold text-slate-800">
                                {{ $event->title }}
                            </h4>

                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-xl text-sm font-semibold">
                                {{ $event->category->name ?? '-' }}
                            </span>

                        </td>

                        <td class="px-6 py-5 text-slate-600">

                            {{ $event->date->format('d M Y') }}

                            <div class="text-xs text-slate-400 mt-1">
                                {{ $event->date->format('H:i') }}
                            </div>

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex gap-2">

                                <a href="{{ route('admin.events.edit', $event->id) }}"
                                   class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-semibold hover:bg-indigo-600 hover:text-white transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.events.destroy', $event->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus event ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl font-semibold hover:bg-rose-600 hover:text-white transition">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-16">

                            <div class="flex flex-col items-center">

                                <div class="text-5xl mb-3">
                                    🎟️
                                </div>

                                <h3 class="font-bold text-slate-700">
                                    Belum Ada Event
                                </h3>

                                <p class="text-slate-400 text-sm mt-2">
                                    Silakan tambahkan event baru terlebih dahulu.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-6">
    {{ $events->links() }}
</div>


</div>

@endsection
