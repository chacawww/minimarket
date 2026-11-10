<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function checkout(Order $order)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->invoice_number,
                'gross_amount' => (int) $order->grand_total,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('transactions.payment', compact('order', 'snapToken'));
    }

    public function notification()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');

        $notification = new Notification();

        $order = Order::where(
            'invoice_number',
            $notification->order_id
        )->first();

        if (!$order) {
            return response()->json([
                'message' => 'Pesanan tidak ditemukan.',
            ], 404);
        }

        $status = $notification->transaction_status;

        if (in_array($status, ['settlement', 'capture'])) {
            $order->status = 'dibayar';
        } elseif ($status === 'pending') {
            $order->status = 'menunggu_pembayaran';
        } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
            $order->status = 'gagal';
        }

        $order->save();

        return response()->json([
            'message' => 'Notifikasi pembayaran berhasil diproses.',
        ]);
    }
}
