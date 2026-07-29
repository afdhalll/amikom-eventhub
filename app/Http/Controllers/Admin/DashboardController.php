<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Partner;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $eventQuery = Event::query();
        $transactionQuery = Transaction::query();

        if ($user->role !== 'superadmin') {

            $eventQuery->where('organization_id', $user->organization_id);

            $transactionQuery->whereHas('event', function ($q) use ($user) {
                $q->where('organization_id', $user->organization_id);
            });
        }

        // =====================
        // CARD STATISTIK
        // =====================

        $totalRevenue = (clone $transactionQuery)
            ->whereIn('status', ['settlement', 'success'])
            ->sum('total_price');

        $ticketsSold = (clone $transactionQuery)
            ->whereIn('status', ['settlement', 'success'])
            ->count();

        $activeEvents = (clone $eventQuery)
            ->where('date', '>=', now())
            ->count();

        $pendingOrders = (clone $transactionQuery)
            ->where('status', 'pending')
            ->count();

        $totalEvents = (clone $eventQuery)->count();

        $totalTransactions = (clone $transactionQuery)->count();

        // =====================
        // KHUSUS SUPERADMIN
        // =====================

        $totalUsers = User::count();

        $totalOrganizations = Organization::count();

        // =====================
        // TRANSAKSI TERBARU
        // =====================

        $recentTransactions = (clone $transactionQuery)
            ->with('event')
            ->latest()
            ->take(5)
            ->get();

     // =====================
// DATA GRAFIK PENDAPATAN
// =====================

$monthlyRevenue = Transaction::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(total_price) as total')
    )
    ->whereIn('status', ['success', 'settlement'])
    ->groupBy('month')
    ->orderBy('month')
    ->get();

$chartLabels = [];
$chartData = [];

foreach ($monthlyRevenue as $item) {

    $chartLabels[] = date('M', mktime(0, 0, 0, $item->month, 1));

    $chartData[] = $item->total;
}

// =====================
// PIE CHART STATUS TRANSAKSI
// =====================

$successCount = (clone $transactionQuery)
    ->whereIn('status', ['success', 'settlement'])
    ->count();

$pendingCount = (clone $transactionQuery)
    ->where('status', 'pending')
    ->count();

$failedCount = (clone $transactionQuery)
    ->whereIn('status', ['failed', 'cancel', 'deny', 'expire'])
    ->count();

// =====================
// DOUGHNUT DATA SISTEM
// =====================

$systemLabels = [
    'Event',
    'Partner',
    'Kategori',
    'User'
];

$systemData = [
    Event::count(),
    Partner::count(),
    Category::count(),
    User::count(),
];

return view('admin.dashboard', compact(
    'totalRevenue',
    'ticketsSold',
    'activeEvents',
    'pendingOrders',
    'totalEvents',
    'totalTransactions',
    'totalUsers',
    'totalOrganizations',
    'recentTransactions',

    // Bar Chart
    'chartLabels',
    'chartData',

    // Pie Chart
    'successCount',
    'pendingCount',
    'failedCount',

    // Doughnut Chart
    'systemLabels',
    'systemData'
));
    }
}