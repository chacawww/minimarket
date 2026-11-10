<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $produks = Produk::where('stok', '>', 0)->get();

        return view('transactions.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|array|min:1',
            'produk_id.*' => 'required|exists:produks,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        $order = DB::transaction(function () use ($validated) {
            $total = 0;
            $details = [];

            foreach ($validated['produk_id'] as $index => $produkId) {
                $quantity = (int) $validated['quantity'][$index];

                if ($quantity === 0) {
                    continue;
                }

                $produk = Produk::whereKey($produkId)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($produk->stok < $quantity) {
                    throw new \RuntimeException(
                        "Stok {$produk->nama_produk} tidak mencukupi."
                    );
                }

                $subtotal = $produk->harga * $quantity;
                $total += $subtotal;

                $details[] = [
                    'produk' => $produk,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
            }

            if (count($details) === 0) {
                throw new \RuntimeException(
                    'Pilih minimal satu produk untuk transaksi.'
                );
            }

            $discount = min(
                (float) ($validated['discount'] ?? 0),
                $total
            );

            $order = Order::create([
                'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . random_int(100, 999),
                'order_date' => now(),
                'total' => $total,
                'discount' => $discount,
                'grand_total' => $total - $discount,
                'status' => 'menunggu_pembayaran',
            ]);

            foreach ($details as $detail) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'produk_id' => $detail['produk']->id,
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['produk']->harga,
                    'subtotal' => $detail['subtotal'],
                ]);

                $detail['produk']->decrement(
                    'stok',
                    $detail['quantity']
                );
            }

            return $order;
        });

        return redirect()
            ->route('midtrans.checkout', $order->id);
    }

    public function receipt(Order $order)
    {
        $order->load('items.produk');

        return view('transactions.receipt', compact('order'));
    }
}
