<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Kasir</title>

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
        <h2>Dashboard Kasir</h2>
    </div>

    <div class="container">

        <div class="card">

            <h1>Selamat Datang, Kasir!</h1>

            <p>
                Anda login sebagai Kasir.
            </p>

            <p>
                Kasir dapat mengelola transaksi penjualan.
            </p>

            <a href="#">
                Transaksi
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