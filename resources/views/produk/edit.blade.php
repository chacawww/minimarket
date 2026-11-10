<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>

    <h1>Edit Produk</h1>

    @if ($errors->any())
        <div>
            <strong>Ada kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Produk</label><br>
            <input
                type="text"
                name="nama_produk"
                value="{{ old('nama_produk', $produk->nama_produk) }}"
            >
        </div>

        <br>

        <div>
            <label>Harga</label><br>
            <input
                type="number"
                name="harga"
                value="{{ old('harga', $produk->harga) }}"
            >
        </div>

        <br>

        <div>
            <label>Stok</label><br>
            <input
                type="number"
                name="stok"
                value="{{ old('stok', $produk->stok) }}"
            >
        </div>

        <br>

        <div>
            <label>Kategori</label><br>
            <input
                type="text"
                name="kategori"
                value="{{ old('kategori', $produk->kategori) }}"
            >
        </div>

        <br>

        <button type="submit">Update Produk</button>
        <a href="{{ route('produk.index') }}">Kembali</a>
    </form>

</body>
</html>