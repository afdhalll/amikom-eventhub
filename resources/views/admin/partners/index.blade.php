@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>

            <h1 class="text-4xl font-black text-slate-800">
                Data Partner
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola seluruh partner yang bekerja sama dengan AmikomEventHub
            </p>

        </div>

        <!-- Button Tambah -->
        <a href="/admin/partners/create"
           class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-6 py-4 rounded-2xl font-bold shadow-lg transition duration-300">

            + Tambah Partner

        </a>

    </div>

    <!-- Search -->
    <div class="bg-white rounded-3xl shadow-sm p-6 border border-slate-100">

        <form action="/admin/partners" method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari partner..."
                       class="flex-1 border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-4 rounded-2xl font-bold shadow-lg transition">

                    Cari

                </button>

            </div>

        </form>

    </div>

    <!-- Alert -->
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-2xl shadow-sm">

            {{ session('success') }}

        </div>

    @endif

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-8">

        @forelse($partners as $partner)

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden border border-slate-100 hover:-translate-y-2">

                <!-- Logo -->
                <div class="bg-gradient-to-br from-slate-50 to-slate-100 h-56 flex items-center justify-center p-6">

                    <img src="{{ $partner->logo_url }}"
                         alt="{{ $partner->name }}"
                         class="max-h-40 object-contain hover:scale-105 transition duration-300">

                </div>

                <!-- Content -->
                <div class="p-6 text-center">

                    <h3 class="font-bold text-xl text-slate-800 mb-6">

                        {{ $partner->name }}

                    </h3>

                    <!-- Buttons -->
                    <div class="flex justify-center gap-3">

                        <!-- Edit -->
                        <a href="/admin/partners/{{ $partner->id }}/edit"
                           class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg">

                            Edit

                        </a>

                        <!-- Delete -->
                        <form action="/admin/partners/{{ $partner->id }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus partner ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg">

                                Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <!-- Empty -->
            <div class="col-span-full bg-white rounded-3xl p-14 text-center shadow-sm border border-slate-100">

                <h3 class="text-3xl font-black text-slate-700 mb-3">

                    Partner Belum Ada

                </h3>

                <p class="text-slate-500 mb-8">

                    Tambahkan partner pertama untuk memulai kerja sama.

                </p>

                <a href="/admin/partners/create"
                   class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-7 py-3 rounded-2xl font-bold shadow-lg transition">

                    Tambah Partner

                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection