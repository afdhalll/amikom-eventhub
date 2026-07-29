@extends('layouts.admin')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

    <div>
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 flex items-center gap-3">
            🏢 Manajemen Organisasi
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola seluruh organisasi yang terdaftar pada platform
            <span class="font-semibold">AmikomEventHub</span>.
        </p>
    </div>

    <a href="{{ route('admin.organizations.create') }}"
        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 transition text-white font-semibold shadow-lg">

        ➕ Tambah Organisasi

    </a>

</div>

@if(session('success'))

<div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-[950px] w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Logo
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Nama Organisasi
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Event
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Deskripsi
                    </th>

                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($organizations as $organization)

                <tr class="border-t hover:bg-slate-50 transition duration-200">

                    <td class="px-6 py-5">

                        @if($organization->logo)

                            <img src="{{ asset('storage/'.$organization->logo) }}"
                                class="w-16 h-16 rounded-xl object-cover border border-slate-200">

                        @else

                            <div class="w-16 h-16 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-2xl">

                                🏢

                            </div>

                        @endif

                    </td>

                    <td class="px-6 py-5 whitespace-nowrap">

                        <div class="font-bold text-slate-800">

                            {{ $organization->name }}

                        </div>

                    </td>

                    <td class="px-6 py-5 whitespace-nowrap">

                        <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-semibold text-indigo-700">

                            {{ $organization->events_count }} Event

                        </span>

                    </td>

                    <td class="px-6 py-5 text-slate-600">

                        {{ Str::limit($organization->description, 60) }}

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex flex-wrap justify-center gap-2">

                            <a href="{{ route('admin.organizations.edit', $organization) }}"
                                class="px-4 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">

                                Edit

                            </a>

                            <form action="{{ route('admin.organizations.destroy', $organization) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus organisasi ini?')"
                                    class="px-4 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="py-20 text-center">

                            <div class="text-6xl mb-3">

                                🏢

                            </div>

                            <h3 class="text-xl font-bold text-slate-700">

                                Belum Ada Organisasi

                            </h3>

                            <p class="text-slate-500 mt-2">

                                Klik tombol <b>Tambah Organisasi</b> untuk membuat organisasi pertama.

                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@if(method_exists($organizations, 'links'))

<div class="mt-6">

    {{ $organizations->links() }}

</div>

@endif

@endsection