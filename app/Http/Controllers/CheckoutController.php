<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class CheckoutController extends Controller
{
    public function create(Event $event)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        return view('checkout.create', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validasi Input Kredensial Pelanggan
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // 2. Cegah Check-out Jika Tiket Habis
        if ($event->stock <= 0) {
            return back()->with(
                'error',
                'Mohon maaf, tiket untuk acara ini sudah habis.'
            );
        }

        // 3. Generate Kode TRX (Unik)
        $orderId = 'TRX-' . time() . '-' . Str::random(5);

        $totalPrice = $event->price + 5000; // Biaya admin

        // 4. Rekam Transaksi ke Database
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => $orderId,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price'    => $totalPrice,
            'status'         => 'Pending',
        ]);

        // ---------------- INTEGRASI MIDTRANS ----------------

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi yang dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email'      => $request->customer_email,
                'phone'      => $request->customer_phone,
            ],
        ];

        try {

            // Generate Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Simpan token ke database
            $transaction->update([
                'snap_token' => $snapToken,
            ]);

            // Redirect ke halaman pembayaran
            return redirect()->route(
                'checkout.payment',
                $transaction->order_id
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Gagal memproses pembayaran jaringan: ' . $e->getMessage()
            );
        }
    }

    public function payment($order_id)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

        return view(
            'checkout.payment',
            compact('transaction', 'categories')
        );
    }
 public function success($order_id)
{
    // Mengambil daftar kategori untuk keperluan menu footer
    $categories = \App\Models\Category::all();

   $transaction = Transaction::with('event')
    ->where('order_id', $order_id)
    ->firstOrFail();

    // Validasi status pembayaran asli dari Midtrans
    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    Config::$isProduction = false;

    try {

        $midtransStatus = MidtransTransaction::status($order_id);

        // Update status jika pembayaran berhasil
        if (
    in_array($midtransStatus->transaction_status, [
        'capture',
        'settlement'
    ]) &&
    $transaction->status != 'Success'
) {

    $transaction->update([
        'status' => 'Success'
    ]);

    if ($transaction->event->stock > 0) {
        $transaction->event->decrement('stock');
    }

}

    } catch (\Exception $e) {

        return redirect('/')
            ->with(
                'error',
                'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.'
            );

    }

    return view(
        'checkout.success',
        compact('transaction', 'categories')
    );
}   
}