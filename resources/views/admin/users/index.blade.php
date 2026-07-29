@extends('layouts.admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

    <div>
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 flex items-center gap-3">
            👤 Manajemen User
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola seluruh akun Admin dan Super Admin.
        </p>
    </div>

    <a href="{{ route('admin.users.create') }}"
        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 transition text-white font-semibold shadow-lg">

        ➕ Tambah User

    </a>

</div>

@if(session('success'))

<div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[900px] w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Nama
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Role
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Organisasi
                    </th>

                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                <tr class="border-t hover:bg-slate-50 transition">

                    <td class="px-6 py-5 font-semibold whitespace-nowrap">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-5 whitespace-nowrap">
                        {{ $user->email }}
                    </td>

                    <td class="px-6 py-5 whitespace-nowrap">

                        @if($user->role == 'superadmin')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                Super Admin
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                Admin
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-5 whitespace-nowrap">
                        {{ $user->organization->name ?? '-' }}
                    </td>

                    <td class="px-6 py-5">

                        <div class="flex flex-wrap justify-center gap-2">

                            <a href="{{ route('admin.users.edit',$user) }}"
                                class="px-4 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">

                                Edit

                            </a>

                            @if($user->role != 'superadmin')

                            <form action="{{ route('admin.users.destroy',$user) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus user ini?')"
                                    class="px-4 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">

                                    Hapus

                                </button>

                            </form>

                            @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="py-20 text-center">

                            <div class="text-6xl mb-4">
                                👤
                            </div>

                            <h2 class="text-2xl font-bold">
                                Belum Ada User
                            </h2>

                            <p class="text-slate-500 mt-2">
                                Klik tombol Tambah User untuk membuat akun pertama.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@if(method_exists($users,'links'))

<div class="mt-6">

    {{ $users->links() }}

</div>

@endif

@endsection