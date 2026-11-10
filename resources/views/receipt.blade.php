
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Minimarket</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        .struk {
            background: white;
            width: 320px;
            margin: auto;
            padding: 25px;
            box-shadow: 0 2px 10px #ccc;
        }

        h2, p {
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

        button {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background: #198754;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk {
                box-shadow: none;
            }

            button {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="struk">
    <h2>MINIMARKET</h2>
    <p>Struk Pembelian</p>
    <p>{{ date('d-m-Y H:i:s') }}</p>

    <hr>

    <table>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td align="right">
                    {{ $item['jumlah'] }} x
                    Rp{{ number_format($item['harga'], 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    Rp{{ number_format($item['jumlah'] * $item['harga'], 0, ',', '.') }}
                </td>
            </tr>
        @endforeach

        <tr class="total">
            <td>Total</td>
            <td align="right">
                Rp{{ number_format($total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <hr>

    <p>Terima kasih telah berbelanja!</p>

    <button onclick="window.print()">Cetak / Simpan PDF</button>
</div>

</body>
</html>
