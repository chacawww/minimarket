<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;

class OrderController extends Controller
{
    public function store()
    {
        event(new OrderPlaced(
            'Pesanan baru berhasil dibuat!'
        ));

        return response()->json([
            'message' => 'Event pesanan berhasil dikirim!'
        ]);
    }
}
