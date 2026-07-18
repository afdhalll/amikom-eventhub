<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menjumlahkan seluruh nominal transaksi yang berhasil
        $totalRevenue = Transaction::whereIn('status', [
            'settlement',
            'success'
        ])->sum('total_price');

        // 2. Menghitung jumlah tiket yang berhasil terjual
        $ticketsSold = Transaction::whereIn('status', [
            'settlement',
            'success'
        ])->count();

        // 3. Menghitung jumlah event yang masih aktif
        $activeEvents = Event::where('date', '>=', now())->count();

        // 4. Menghitung jumlah transaksi yang masih pending
        $pendingOrders = Transaction::where('status', 'pending')->count();

        // 5. Mengambil 5 transaksi terbaru
        $recentTransactions = Transaction::with('event')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'totalRevenue',
                'ticketsSold',
                'activeEvents',
                'pendingOrders',
                'recentTransactions'
            )
        );
    }
}