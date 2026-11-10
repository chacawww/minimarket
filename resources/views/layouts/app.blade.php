
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Notifikasi Real-Time -->
    <div id="order-notification"
         style="display:none; position:fixed; top:20px; right:20px;
                background:#d1fae5; color:#065f46; padding:16px 20px;
                border-radius:10px; z-index:9999;">
    </div>

    <!-- Listener Laravel Echo -->
    <script>
        window.addEventListener('load', function () {
            if (window.Echo) {
                window.Echo.channel('orders')
                    .listen('.order.placed', function (event) {
                        const notification = document.getElementById(
                            'order-notification'
                        );

                        notification.textContent =
                            event.message || 'Pesanan baru diterima!';

                        notification.style.display = 'block';

                        console.log('Event pesanan diterima:', event);
                    });
            } else {
                console.error('Laravel Echo belum tersedia.');
            }
        });
    </script>
</body>
</html>
