@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-black text-slate-800 mb-8">
        Edit Organisasi
    </h1>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('admin.organizations.update', $organization) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Nama Organisasi
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $organization->name) }}"
                    class="w-full border rounded-xl px-4 py-3">

                @error('name')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded-xl px-4 py-3">{{ old('description', $organization->description) }}</textarea>

                @error('description')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            @if($organization->logo)
                <div class="mb-4">
                    <img src="{{ asset('storage/'.$organization->logo) }}"
                         class="w-24 h-24 rounded-xl object-cover">
                </div>
            @endif

            <div class="mb-8">
                <label class="block font-semibold mb-2">
                    Logo Baru (Opsional)
                </label>

                <input
                    type="file"
                    name="logo"
                    class="w-full border rounded-xl px-4 py-3">

                @error('logo')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">

                <button
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl">

                    Update

                </button>

                <a href="{{ route('admin.organizations.index') }}"
                   class="px-6 py-3 bg-gray-300 rounded-xl">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection