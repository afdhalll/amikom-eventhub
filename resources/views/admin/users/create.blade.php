@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-black text-slate-800 mb-8">
        Tambah User
    </h1>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('admin.users.store') }}" method="POST">

            @csrf

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Nama
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
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                @error('email')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                @error('password')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Role
                </label>

                <select
                    name="role"
                    id="role"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    <option value="">-- Pilih Role --</option>

                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                        Super Admin
                    </option>

                </select>

                @error('role')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8" id="organization-wrapper">

                <label class="block font-semibold mb-2">
                    Organisasi
                </label>

                <select
                    name="organization_id"
                    class="w-full border rounded-xl px-4 py-3">

                    <option value="">-- Pilih Organisasi --</option>

                    @foreach($organizations as $organization)

                        <option
                            value="{{ $organization->id }}"
                            {{ old('organization_id') == $organization->id ? 'selected' : '' }}>

                            {{ $organization->name }}

                        </option>

                    @endforeach

                </select>

                @error('organization_id')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror

            </div>

            <div class="flex gap-4">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700">

                    Simpan

                </button>

                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

<script>

const role = document.getElementById('role');
const organization = document.getElementById('organization-wrapper');

function toggleOrganization()
{
    if(role.value === 'superadmin')
    {
        organization.style.display = 'none';
    }
    else
    {
        organization.style.display = 'block';
    }
}

toggleOrganization();

role.addEventListener('change', toggleOrganization);

</script>

@endsection