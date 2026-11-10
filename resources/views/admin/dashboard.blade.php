<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }

        .navbar {
            background: #212529;
            color: white;
            padding: 20px;
        }

        .container {
            padding: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Dashboard Admin</h2>
    </div>

    <div class="container">

        <div class="card">

            <h1>Selamat Datang, Admin!</h1>

            <p>
                Anda login sebagai Administrator.
            </p>

            <p>
                Admin dapat mengelola produk, kategori, pengguna,
                transaksi, dan laporan.
            </p>

            <a href="{{ route('produk.index') }}">
                Kelola Produk
            </a>

            <br>

            <form method="POST" action="{{ route('logout') }}" class="logout">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>

        </div>

    </div>

</body>
</html>