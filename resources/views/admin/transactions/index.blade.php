@extends('layouts.admin')

@section('title', 'Laporan Transaksi - Admin')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus kas dan penjualan tiket Anda.')

@section('content')

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-lg overflow-hidden">

    <!-- Header -->
    <div class="px-8 py-6 border-b bg-gradient-to-r from-indigo-50 to-white">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-2xl">
                📊
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-800">
                    Data Transaksi Event
                </h2>

                <p class="text-sm text-slate-500">
                    Seluruh transaksi pembelian tiket akan tampil pada halaman ini.
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left border-collapse">

            <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-5">Order ID</th>
                    <th class="px-8 py-5">Pembeli</th>
                    <th class="px-8 py-5">Event</th>
                    <th class="px-8 py-5">Tanggal</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5 text-right">Total</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($transactions as $trx)

                <tr class="hover:bg-indigo-50/40 transition duration-200">

                    <td class="px-8 py-6">
                        <span class="font-mono text-sm font-bold bg-indigo-50 text-indigo-600 px-3 py-2 rounded-xl">
                            {{ $trx->order_id }}
                        </span>
                    </td>

                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-800">
                            {{ $trx->customer_name }}
                        </p>

                        <p class="text-xs text-slate-500 mt-1">
                            {{ $trx->customer_email }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ $trx->customer_phone }}
                        </p>
                    </td>

                    <td class="px-8 py-6">
                        <span class="font-semibold text-slate-700">
                            {{ $trx->event->title ?? '-' }}
                        </span>
                    </td>

                    <td class="px-8 py-6 text-sm text-slate-500">
                        {{ $trx->created_at->format('d M Y') }}
                        <br>
                        <span class="text-xs text-slate-400">
                            {{ $trx->created_at->format('H:i') }}
                        </span>
                    </td>

                    <td class="px-8 py-6">

                        @if($trx->status == 'Success')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                ✅ Success
                            </span>

                        @elseif($trx->status == 'Pending')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                ⏳ Pending
                            </span>

                        @elseif($trx->status == 'Failed')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                ❌ Failed
                            </span>

                        @elseif($trx->status == 'Expired')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-xs font-bold">
                                ⌛ Expired
                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">
                                {{ $trx->status }}
                            </span>

                        @endif

                    </td>

                    <td class="px-8 py-6 text-right">

                        <span class="text-lg font-black text-emerald-600">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </span>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="px-8 py-16 text-center">

                        <div class="flex flex-col items-center gap-3">

                            <div class="text-5xl">
                                📭
                            </div>

                            <p class="font-bold text-slate-600">
                                Belum ada transaksi
                            </p>

                            <p class="text-sm text-slate-400">
                                Data transaksi akan muncul setelah pengguna melakukan checkout.
                            </p>

                        </div>

                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="px-8 py-6 bg-slate-50 border-t">
        {{ $transactions->links() }}
    </div>

</div>

@endsection