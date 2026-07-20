<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        // Validasi Input
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // Cek stok
        if ($event->stock <= 0) {
            return back()->with(
                'error',
                'Mohon maaf, tiket untuk acara ini sudah habis.'
            );
        }

        // Generate Order ID
        $orderId = 'TRX-' . time() . '-' . Str::random(5);

        $totalPrice = $event->price + 5000;

        // Simpan transaksi
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => $orderId,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price'    => $totalPrice,
            'status'         => 'Pending',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

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

            $snapToken = Snap::getSnapToken($params);

            $transaction->update([
                'snap_token' => $snapToken,
            ]);

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
        // Mengambil daftar kategori untuk footer
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {

            // Ambil status transaksi dari Midtrans
            $status = MidtransTransaction::status($order_id);

            if ($status) {

                $trx_status = is_array($status)
                    ? ($status['transaction_status'] ?? '')
                    : ($status->transaction_status ?? '');

                // Jika pembayaran berhasil
                if (in_array($trx_status, ['settlement', 'capture'])) {

                    // Hanya jika database masih Pending
                    if (strtolower($transaction->status) == 'pending') {

                        $transaction->update([
                            'status' => 'Success'
                        ]);

                        // Kurangi stok event
                        if ($transaction->event && $transaction->event->stock > 0) {

                            $transaction->event->stock =
                                $transaction->event->stock - 1;

                            $transaction->event->save();

                            // Kirim E-Ticket
                            try {

                                Mail::to($transaction->customer_email)
                                    ->send(new \App\Mail\EventTicketMail($transaction));

                            } catch (\Exception $e) {

                                Log::error(
                                    'Gagal mengirim E-Ticket (Bypass): ' .
                                    $e->getMessage()
                                );

                            }

                        }

                    }

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