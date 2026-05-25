@extends('layouts.admin')

@section('content')

<div class="max-w-2xl">

    <!-- Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">

        <!-- Header -->
        <div class="mb-8">

            <h1 class="text-3xl font-black text-slate-800">
                Edit Kategori
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui data kategori event
            </p>

        </div>

        <!-- Error -->
        @if ($errors->any())

            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl">

                <ul class="list-disc pl-5 space-y-1">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Form -->
        <form action="{{ route('admin.categories.update', $category->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Input -->
            <div>

                <label class="block font-bold text-slate-700 mb-3">

                    Nama Kategori

                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       placeholder="Masukkan nama kategori"
                       class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            </div>

            <!-- Button -->
            <div class="flex gap-4 pt-4">

                <button type="submit"
                        class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:scale-105 text-white px-6 py-3 rounded-2xl font-bold shadow-lg transition duration-300">

                    Update Kategori

                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl font-bold transition">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection