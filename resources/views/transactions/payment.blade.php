<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Midtrans</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
</head>
<body>
    <h2>Pembayaran Transaksi</h2>
    <p>Nomor Invoice: {{ $order->invoice_number }}</p>
    <p>Total Pembayaran: Rp{{ number_format($order->grand_total, 0, ',', '.') }}</p>

    <button id="pay-button">Bayar Sekarang</button>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function () {
                    alert('Pembayaran berhasil!');
                    window.location.href = '/transactions/{{ $order->id }}/receipt';
                },
                onPending: function () {
                    alert('Menunggu pembayaran.');
                    window.location.href = '/transactions/{{ $order->id }}/receipt';
                },
                onError: function () {
                    alert('Pembayaran gagal!');
                },
                onClose: function () {
                    alert('Halaman pembayaran ditutup.');
                }
            });
        });
    </script>
</body>
</html>
