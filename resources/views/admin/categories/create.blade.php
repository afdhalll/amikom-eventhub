@extends('layouts.admin')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow-sm max-w-2xl">

    <!-- Header -->
    <div class="mb-8">

        <h1 class="text-3xl font-black text-slate-800">
            Tambah Kategori
        </h1>

        <p class="text-slate-500 mt-2">
            Tambahkan kategori event baru
        </p>

    </div>

    <!-- Error -->
    @if ($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-2xl">

            <ul class="list-disc pl-5 space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Form -->
    <form action="{{ route('admin.categories.store') }}" method="POST">

        @csrf

        <div class="mb-6">

            <label class="block font-bold mb-3 text-slate-700">
                Nama Kategori
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama kategori"
                   class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        </div>

        <!-- Button -->
        <div class="flex gap-4">

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition">

                Simpan Kategori

            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl font-bold transition">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection