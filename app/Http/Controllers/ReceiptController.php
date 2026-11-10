<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function print()
    {
        $items = [
            [
                'nama' => 'Kopi Susu',
                'jumlah' => 2,
                'harga' => 15000,
            ],
            [
                'nama' => 'Roti Coklat',
                'jumlah' => 1,
                'harga' => 10000,
            ],
        ];

        $total = 0;

        foreach ($items as $item) {
            $total += $item['jumlah'] * $item['harga'];
        }

        return view('receipt', compact('items', 'total'));
    }
}
