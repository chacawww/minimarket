<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        .struk {
            background: white;
            width: 350px;
            margin: auto;
            padding: 25px;
            box-shadow: 0 2px 10px #ccc;
        }

        h2, .center {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 8px 0;
            font-size: 14px;
        }

        .total {
            border-top: 1px dashed black;
            font-weight: bold;
        }

        button, .bayar {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background: #198754;
            color: white;
            border: none;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }

        .status {
            text-align: center;
            font-weight: bold;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk {
                box-shadow: none;
            }

            button, .bayar {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="struk">

    <h2>MINIMARKET</h2>
    <p class="center">Struk Pembelian</p>

    <p>No. Invoice: {{ $order->invoice_number }}</p>
    <p>Tanggal: {{ $order->order_date->format('d-m-Y H:i:s') }}</p>
    <p class="status">
        Status Pembayaran: {{ ucfirst(str_replace('_', ' ', $order->status)) }}
    </p>

    <hr>

    <table>
        @foreach ($order->items as $item)
            <tr>
                <td colspan="2">{{ $item->produk->nama_produk }}</td>
            </tr>

            <tr>
                <td>
                    {{ $item->quantity }} x
                    Rp{{ number_format($item->unit_price, 0, ',', '.') }}
                </td>
                <td align="right">
                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach

        <tr>
            <td>Total</td>
            <td align="right">
                Rp{{ number_format($order->total, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td>Diskon</td>
            <td align="right">
                Rp{{ number_format($order->discount, 0, ',', '.') }}
            </td>
        </tr>

        <tr class="total">
            <td>Total Bayar</td>
            <td align="right">
                Rp{{ number_format($order->grand_total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <hr>

    <p class="center">Terima kasih telah berbelanja!</p>

    @if ($order->status === 'menunggu_pembayaran')
        <a class="bayar" href="{{ route('midtrans.checkout', $order->id) }}">
            Bayar Sekarang
        </a>
    @endif

    <button onclick="window.print()">Cetak / Simpan PDF</button>

</div>

</body>
</html>
