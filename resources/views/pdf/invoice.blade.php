
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Minimarket</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background: #eee; }
        .total { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>INVOICE MINIMARKET</h2>
    <p>Tanggal: {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->kategori }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">
        Total Nilai Stok:
        Rp {{ number_format($totalNilai, 0, ',', '.') }}
    </p>
</body>
</html>
