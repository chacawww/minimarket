
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Minimarket</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        .container {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        input[type="number"] {
            width: 80px;
            padding: 7px;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #198754;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<div class="container">

    <h2>Transaksi Minimarket</h2>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Jumlah Beli</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($produks as $produk)
                    <tr>
                        <td>{{ $produk->nama_produk }}</td>

                        <td>
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </td>

                        <td>{{ $produk->stok }}</td>

                        <td>
                            <input
                                type="hidden"
                                name="produk_id[]"
                                value="{{ $produk->id }}"
                            >

                            <input
                                type="number"
                                name="quantity[]"
                                min="0"
                                max="{{ $produk->stok }}"
                                value="0"
                            >
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            Belum ada produk yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p>
            <label>Diskon (Rp):</label>
            <input type="number" name="discount" min="0" value="0">
        </p>

        <button type="submit">Simpan Transaksi</button>
    </form>

</div>
</body>
</html>
