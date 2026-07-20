<?php

namespace App\Http\Controllers;

use App\Mail\EventTicketMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId) {
            return response()->json([
                'message' => 'Invalid payload'
            ], 400);
        }

        // Cari transaksi
        $transaction = Transaction::with('event')
            ->where('order_id', $orderId)
            ->first();

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        // Hindari proses dua kali
        if (
            $transaction->status === 'settlement' ||
            $transaction->status === 'success'
        ) {
            return response()->json([
                'message' => 'Already processed'
            ]);
        }

        // Mapping status Midtrans
        if ($transactionStatus == 'capture') {

            if ($fraudStatus == 'challenge') {

                $transaction->status = 'challenge';

            } elseif ($fraudStatus == 'accept') {

                $transaction->status = 'success';
                $this->processSuccess($transaction);

            }

        } elseif ($transactionStatus == 'settlement') {

            $transaction->status = 'settlement';
            $this->processSuccess($transaction);

        } elseif (in_array($transactionStatus, [
            'cancel',
            'deny',
            'expire'
        ])) {

            $transaction->status = 'failed';

        } elseif ($transactionStatus == 'pending') {

            $transaction->status = 'pending';

        }

        $transaction->save();

        return response()->json([
            'message' => 'OK'
        ]);
    }

    private function processSuccess(Transaction $transaction)
    {
        $event = $transaction->event;

        // Jika tiket masih tersedia
        if ($event && $event->stock > 0) {

            // Kurangi stok
            $event->stock = $event->stock - 1;
            $event->save();

            // Kirim Email E-Ticket
            try {

                Mail::to($transaction->customer_email)
                    ->send(new EventTicketMail($transaction));

            } catch (\Exception $e) {

                Log::error(
                    'Gagal mengirim email E-Ticket: ' .
                    $e->getMessage()
                );

            }

        } else {

            Log::warning(
                'Stock habis setelah pembayaran berhasil (Perlu proses refund opsional). Order: '
                . $transaction->order_id
            );

        }
    }
}