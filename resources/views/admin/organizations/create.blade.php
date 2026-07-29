@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-black text-slate-800 mb-8">
        Tambah Organisasi
    </h1>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('admin.organizations.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Nama Organisasi
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                @error('name')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label class="block font-semibold mb-2">
                    Logo Organisasi
                </label>

                <input
                    type="file"
                    name="logo"
                    class="w-full border rounded-xl px-4 py-3">

                @error('logo')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700">

                    Simpan
                </button>

                <a href="{{ route('admin.organizations.index') }}"
                   class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection