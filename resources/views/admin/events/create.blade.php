@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-5xl mx-auto">


<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">
        Form Tambah Event
    </h2>
    <p class="text-gray-500 mt-2">
        Lengkapi informasi event yang akan ditampilkan pada website.
    </p>
</div>

@if ($errors->any())
    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.events.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

    @csrf

    {{-- Judul Event --}}
    <div class="mb-5">
        <label class="block mb-2 font-medium text-gray-700">
            Judul Event
        </label>

        <input type="text"
               name="title"
               value="{{ old('title') }}"
               placeholder="Masukkan judul event"
               class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
               required>
    </div>

    {{-- Kategori --}}
    <div class="mb-5">
        <label class="block mb-2 font-medium text-gray-700">
            Kategori Event
        </label>

        <select name="category_id"
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
                required>

            <option value="">
                -- Pilih Kategori --
            </option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach

        </select>
    </div>

    {{-- Deskripsi --}}
    <div class="mb-5">
        <label class="block mb-2 font-medium text-gray-700">
            Deskripsi Event
        </label>

        <textarea name="description"
                  rows="4"
                  placeholder="Masukkan deskripsi event"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
                  required>{{ old('description') }}</textarea>
    </div>

    {{-- Tanggal Harga Stok --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">

        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Tanggal & Waktu
            </label>

            <input type="datetime-local"
                   name="date"
                   value="{{ old('date') }}"
                   class="w-full border border-gray-300 p-3 rounded-lg"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Harga Tiket (Rp)
            </label>

            <input type="number"
                   name="price"
                   value="{{ old('price') }}"
                   placeholder="50000"
                   class="w-full border border-gray-300 p-3 rounded-lg"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Kapasitas Stok
            </label>

            <input type="number"
                   name="stock"
                   value="{{ old('stock') }}"
                   placeholder="100"
                   class="w-full border border-gray-300 p-3 rounded-lg"
                   required>
        </div>

    </div>

    {{-- Lokasi --}}
    <div class="mb-5">
        <label class="block mb-2 font-medium text-gray-700">
            Lokasi / Gedung
        </label>

        <input type="text"
               name="location"
               value="{{ old('location') }}"
               placeholder="Gedung Serbaguna Amikom"
               class="w-full border border-gray-300 p-3 rounded-lg"
               required>
    </div>

    {{-- Upload Poster --}}

<div class="mb-6">

    <label class="block mb-2 font-medium text-gray-700">
        Poster Event (Opsional)
    </label>

    <input type="file"
           name="poster"
           accept="image/*"
           class="w-full border border-gray-300 p-2.5 rounded-lg border border-gray-300">

    <p class="text-sm text-gray-500 mt-2">
        Format yang didukung: JPG, JPEG, PNG (Maksimal 2 MB)
    </p>

</div>


    </div>

    {{-- Tombol --}}
    <div class="flex justify-end gap-3 border-t pt-5">

        <a href="{{ route('admin.events.index') }}"
           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            Batal
        </a>

        <button type="submit"
                class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow">

            Simpan Data

        </button>

    </div>

</form>


</div>

@endsection