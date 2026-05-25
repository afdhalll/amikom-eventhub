@extends('layouts.admin')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow-sm max-w-2xl">

    <!-- Header -->
    <div class="mb-8">

        <h1 class="text-3xl font-black text-slate-800">
            Tambah Partner
        </h1>

        <p class="text-slate-500 mt-2">
            Tambahkan partner baru untuk AmikomEventHub
        </p>

    </div>

    <!-- Error Alert -->
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
    <form action="/admin/partners/store" method="POST">

        @csrf

        <!-- Nama Partner -->
        <div class="mb-6">

            <label class="block font-bold mb-3 text-slate-700">
                Nama Partner
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama partner"
                   class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        </div>

        <!-- Logo URL -->
        <div class="mb-6">

            <label class="block font-bold mb-3 text-slate-700">
                Link Logo Partner
            </label>

            <input type="text"
                   name="logo_url"
                   value="{{ old('logo_url') }}"
                   placeholder="https://example.com/logo.png"
                   class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            <p class="text-sm text-slate-400 mt-2">
                Gunakan link gambar/logo yang valid
            </p>

        </div>

        <!-- Button -->
        <div class="flex gap-4">

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition">

                Simpan Partner

            </button>

            <a href="/admin/partners"
               class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl font-bold transition">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection