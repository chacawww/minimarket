<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-2 bg-dark min-vh-100 p-0">

                <div class="text-white p-3">
                    <h4>Minimarket</h4>
                    <hr>
                </div>

                <div class="nav flex-column">

                    <a href="/admin" class="nav-link text-white">
                        Dashboard
                    </a>

                    <a href="{{ route('produk.index') }}"
                       class="nav-link text-white">
                        Produk
                    </a>

                    <a href="#" class="nav-link text-white">
                        Kategori
                    </a>

                    <a href="#" class="nav-link text-white">
                        Transaksi
                    </a>

                    <a href="#" class="nav-link text-white">
                        Pengguna
                    </a>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="col-md-10 p-0">

                <!-- HEADER -->
                <nav class="navbar navbar-light bg-light border-bottom px-4">
                    <span class="navbar-brand">
                        @yield('page-title', 'Dashboard')
                    </span>

                    <span>
                        Admin
                    </span>
                </nav>

                <!-- ISI HALAMAN -->
                <main class="p-4">

                    @yield('content')

                </main>

            </div>

        </div>
    </div>

</body>
</html>