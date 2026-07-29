@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-black text-slate-800 mb-8">
        Edit User
    </h1>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('admin.users.update', $user) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-xl px-4 py-3">

                @error('name')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-xl px-4 py-3">

                @error('email')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-xl px-4 py-3">

                <small class="text-gray-500">
                    Kosongkan jika password tidak ingin diubah.
                </small>

                @error('password')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full border rounded-xl px-4 py-3">

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Role
                </label>

                <select
                    id="role"
                    name="role"
                    class="w-full border rounded-xl px-4 py-3">

                    <option value="admin"
                        {{ $user->role == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="superadmin"
                        {{ $user->role == 'superadmin' ? 'selected' : '' }}>
                        Super Admin
                    </option>

                </select>

            </div>

            <div class="mb-8" id="organization-wrapper">

                <label class="block font-semibold mb-2">
                    Organisasi
                </label>

                <select
                    name="organization_id"
                    class="w-full border rounded-xl px-4 py-3">

                    <option value="">
                        -- Pilih Organisasi --
                    </option>

                    @foreach($organizations as $organization)

                        <option
                            value="{{ $organization->id }}"
                            {{ $user->organization_id == $organization->id ? 'selected' : '' }}>

                            {{ $organization->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="flex gap-4">

                <button
                    class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold">

                    Update

                </button>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 rounded-xl bg-slate-200">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

<script>

const role = document.getElementById('role');
const org = document.getElementById('organization-wrapper');

function toggleOrg()
{
    if(role.value === 'superadmin')
    {
        org.style.display = 'none';
    }
    else
    {
        org.style.display = 'block';
    }
}

toggleOrg();

role.addEventListener('change', toggleOrg);

</script>

@endsection