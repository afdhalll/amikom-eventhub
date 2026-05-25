@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>

            <h1 class="text-4xl font-black text-slate-800">
                Data Kategori
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola kategori event AmikomEventHub
            </p>

        </div>

        <!-- Button -->
        <a href="/admin/categories/create"
           class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-6 py-4 rounded-2xl font-bold shadow-lg transition duration-300">

            + Tambah Kategori

        </a>

    </div>

    <!-- Alert -->
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-2xl shadow-sm">

            {{ session('success') }}

        </div>

    @endif

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($categories as $category)

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-md hover:shadow-2xl transition duration-300 border border-slate-100 hover:-translate-y-2 overflow-hidden">

                <!-- Top -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-8 text-white">

                    <h2 class="text-2xl font-black">

                        {{ $category->name }}

                    </h2>

                    <p class="text-indigo-100 mt-2">

                        Kategori Event

                    </p>

                </div>

                <!-- Bottom -->
                <div class="p-6">

                    <div class="flex justify-between items-center">

                        <div>

                            <p class="text-slate-400 text-sm">
                                Slug
                            </p>

                            <p class="font-bold text-slate-700">
                                {{ $category->slug }}
                            </p>

                        </div>

                        <div class="flex gap-3">

                            <!-- Edit -->
                            <a href="/admin/categories/{{ $category->id }}/edit"
                               class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-4 py-2 rounded-xl font-semibold transition shadow-lg">

                                Edit

                            </a>

                            <!-- Delete -->
                            <form action="/admin/categories/{{ $category->id }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white px-4 py-2 rounded-xl font-semibold transition shadow-lg">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <!-- Empty -->
            <div class="col-span-full bg-white rounded-3xl p-14 text-center shadow-sm border border-slate-100">

                <h3 class="text-3xl font-black text-slate-700 mb-3">

                    Kategori Belum Ada

                </h3>

                <p class="text-slate-500 mb-8">

                    Tambahkan kategori pertama untuk event.

                </p>

                <a href="/admin/categories/create"
                   class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-7 py-3 rounded-2xl font-bold shadow-lg transition">

                    Tambah Kategori

                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection