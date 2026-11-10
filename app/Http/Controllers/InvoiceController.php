<?php

namespace App\Http\Controllers; 

use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate()
    {
        $produks = Produk::all();

        $totalNilai = $produks->sum(function ($produk) {
            return $produk->harga * $produk->stok;
        });

        $pdf = Pdf::loadView('pdf.invoice', compact(
            'produks',
            'totalNilai'
        ));

        return $pdf->stream('invoice-minimarket.pdf');
    }
}
