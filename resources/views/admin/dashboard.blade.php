@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <div>

            <h1 class="text-4xl font-black text-slate-800">
                Dashboard Ringkasan
            </h1>

            <p class="text-slate-500 mt-2 text-lg">
                Selamat datang kembali, Admin 👋
            </p>

        </div>

        <!-- Quick Action -->
        <div class="flex flex-wrap gap-4">

            <a href="/admin/events/create"
               class="px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-indigo-700 text-white font-bold shadow-lg hover:scale-105 transition">

                + Tambah Event

            </a>

            <a href="/admin/partners/create"
               class="px-5 py-3 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-600 text-white font-bold shadow-lg hover:scale-105 transition">

                + Tambah Partner

            </a>

            <a href="/admin/categories/create"
               class="px-5 py-3 rounded-2xl bg-gradient-to-r from-orange-400 to-orange-600 text-white font-bold shadow-lg hover:scale-105 transition">

                + Tambah Kategori

            </a>

        </div>

    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Card 1 -->
        <div class="relative overflow-hidden rounded-3xl p-7 bg-gradient-to-br from-indigo-500 to-indigo-700 text-white shadow-2xl shadow-indigo-200 hover:-translate-y-2 transition duration-300">

            <div class="absolute -right-5 -bottom-5 opacity-10">
                <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>

            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">

                💰

            </div>

            <p class="uppercase text-sm font-bold tracking-widest text-indigo-100 mb-2">
                Total Pendapatan
            </p>

           <h3 class="text-4xl font-black">
             Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </h3>

        </div>

        <!-- Card 2 -->
        <div class="relative overflow-hidden rounded-3xl p-7 bg-gradient-to-br from-emerald-400 to-green-600 text-white shadow-2xl shadow-green-200 hover:-translate-y-2 transition duration-300">

            <div class="absolute -right-5 -bottom-5 text-white opacity-10 text-[140px] font-black">
                🎫
            </div>

            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">

                🎟️

            </div>

            <p class="uppercase text-sm font-bold tracking-widest text-green-100 mb-2">
                Tiket Terjual
            </p>

            <h3 class="text-4xl font-black">
              {{ number_format($ticketsSold, 0, ',', '.') }}
            </h3>

        </div>

        <!-- Card 3 -->
        <div class="relative overflow-hidden rounded-3xl p-7 bg-gradient-to-br from-orange-400 to-red-500 text-white shadow-2xl shadow-orange-200 hover:-translate-y-2 transition duration-300">

            <div class="absolute -right-5 -bottom-5 opacity-10 text-[140px]">
                🎉
            </div>

            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">

                📅

            </div>

            <p class="uppercase text-sm font-bold tracking-widest text-orange-100 mb-2">
                Event Aktif
            </p>

            <h3 class="text-4xl font-black">
             {{ $activeEvents }} Event
            </h3>

        </div>

        <!-- Card 4 -->
        <div class="relative overflow-hidden rounded-3xl p-7 bg-gradient-to-br from-pink-500 to-rose-600 text-white shadow-2xl shadow-pink-200 hover:-translate-y-2 transition duration-300">

            <div class="absolute -right-5 -bottom-5 opacity-10 text-[140px]">
                ⏳
            </div>

            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">

                🛒

            </div>

            <p class="uppercase text-sm font-bold tracking-widest text-pink-100 mb-2">
                Pesanan Pending
            </p>

            <h3 class="text-4xl font-black">
                 {{ $pendingOrders }} Pesanan
            </h3>

        </div>

    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <!-- Transaction Table -->
        <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

            <!-- Header -->
            <div class="p-8 border-b flex items-center justify-between">

                <div>

                    <h3 class="text-2xl font-black text-slate-800">
                        Transaksi Terakhir
                    </h3>

                    <p class="text-slate-500 mt-1">
                        Daftar transaksi terbaru pengguna
                    </p>

                </div>

                <a href="{{ route('admin.transactions.index') }}"
                class="text-indigo-600 font-bold hover:underline">

                 Lihat Semua

                    </a>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr class="text-left text-slate-400 uppercase text-xs tracking-widest">

                            <th class="px-8 py-5">Pembeli</th>
                            <th class="px-8 py-5">Event</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5">Total</th>

                        </tr>

                    </thead>

                   <tbody class="divide-y divide-slate-100">

    @forelse($recentTransactions as $trx)

        <tr class="hover:bg-slate-50 transition">

            <td class="px-8 py-6">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-black">
                        {{ strtoupper(substr($trx->customer_name, 0, 1)) }}
                    </div>

                    <div>

                        <p class="font-bold text-slate-800">
                            {{ $trx->customer_name }}
                        </p>

                        <p class="text-sm text-slate-400">
                            {{ $trx->customer_email }}
                        </p>

                    </div>

                </div>

            </td>

            <td class="px-8 py-6 font-semibold text-slate-600">
                {{ $trx->event->title ?? '-' }}
            </td>

           <td class="px-8 py-6">

    @php
        $status = strtolower($trx->status);
    @endphp

    @if(in_array($status, ['success', 'settlement']))
        <span class="px-4 py-2 rounded-xl bg-green-100 text-green-700 text-xs font-bold uppercase">
            ✅ Success
        </span>

    @elseif($status == 'pending')
        <span class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 text-xs font-bold uppercase">
            ⏳ Pending
        </span>

    @elseif(in_array($status, ['cancel','deny','expire','failed']))
        <span class="px-4 py-2 rounded-xl bg-red-100 text-red-700 text-xs font-bold uppercase">
            ❌ {{ ucfirst($status) }}
        </span>

    @else
        <span class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold uppercase">
            {{ $trx->status }}
        </span>
    @endif

</td>

            <td class="px-8 py-6 font-black text-indigo-600 text-lg">
                Rp {{ number_format($trx->total_price, 0, ',', '.') }}
            </td>

        </tr>

    @empty

        <tr>

            <td colspan="4" class="px-8 py-10 text-center text-slate-500">

                Belum ada transaksi.

            </td>

        </tr>

    @endforelse

</tbody>

                </table>

            </div>

        </div>

        <!-- Activity -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">

            <h3 class="text-2xl font-black text-slate-800 mb-8">

                Aktivitas Admin

            </h3>

            <div class="space-y-6">

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                        🎉
                    </div>

                    <div>

                        <p class="font-bold text-slate-700">
                            Event baru ditambahkan
                        </p>

                        <p class="text-sm text-slate-400">
                            2 menit lalu
                        </p>

                    </div>

                </div>

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-600">
                        🤝
                    </div>

                    <div>

                        <p class="font-bold text-slate-700">
                            Partner baru ditambahkan
                        </p>

                        <p class="text-sm text-slate-400">
                            10 menit lalu
                        </p>

                    </div>

                </div>

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-600">
                        💳
                    </div>

                    <div>

                        <p class="font-bold text-slate-700">
                            Pembayaran berhasil
                        </p>

                        <p class="text-sm text-slate-400">
                            25 menit lalu
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection