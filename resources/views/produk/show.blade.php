<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
</head>
<body>

    <h1>Detail Produk</h1>

    <p>
        <strong>Nama Produk:</strong>
        {{ $produk->nama_produk }}
    </p>

    <p>
        <strong>Harga:</strong>
        Rp {{ number_format($produk->harga, 0, ',', '.') }}
    </p>

    <p>
        <strong>Stok:</strong>
        {{ $produk->stok }}
    </p>

    <p>
        <strong>Kategori:</strong>
        {{ $produk->kategori }}
    </p>

    <br>

    <a href="{{ route('produk.edit', $produk->id) }}">Edit Produk</a>
    |
    <a href="{{ route('produk.index') }}">Kembali ke Daftar Produk</a>

</body>
</html>