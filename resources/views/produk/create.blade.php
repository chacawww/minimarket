
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>

    <h1>Tambah Produk</h1>

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

    <form action="{{ route('produk.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf

        <div>
            <label>Nama Produk</label><br>
            <input type="text" name="nama_produk"
                   value="{{ old('nama_produk') }}" required>
        </div>

        <br>

        <div>
            <label>Harga</label><br>
            <input type="number" name="harga"
                   value="{{ old('harga') }}" required>
        </div>

        <br>

        <div>
            <label>Stok</label><br>
            <input type="number" name="stok"
                   value="{{ old('stok') }}" required>
        </div>

        <br>

        <div>
            <label>Kategori</label><br>
            <input type="text" name="kategori"
                   value="{{ old('kategori') }}" required>
        </div>

        <br>

        <div>
            <label>Gambar Produk</label><br>
            <input type="file" name="gambar"
                   accept="image/jpeg,image/png,image/webp">
        </div>

        <br>

        <div>
            <label>Rotasi Gambar</label><br>
            <select name="rotasi">
                <option value="0">Tidak diputar</option>
                <option value="90">Putar 90 derajat</option>
                <option value="180">Putar 180 derajat</option>
                <option value="270">Putar 270 derajat</option>
            </select>
        </div>

        <br>

        <button type="submit">Simpan Produk</button>
        <a href="{{ route('produk.index') }}">Kembali</a>
    </form>

</body>
</html>
