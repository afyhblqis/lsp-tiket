<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan</title>
</head>
<body>

<h2>Detail Pemesanan</h2>
<a href="/history">← Kembali ke Riwayat</a>

<hr>

<p><strong>Nama Pesawat:</strong> {{ $booking->schedule->plane_name }}</p>
<p><strong>Rute:</strong> {{ $booking->schedule->origin }} ke {{ $booking->schedule->destination }}</p>
<p><strong>Waktu Berangkat:</strong> {{ $booking->schedule->departure }}</p>
<p><strong>Jumlah Kursi:</strong> {{ $booking->total_seats }}</p>
<p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_price) }}</p>
<p><strong>Status Pembayaran:</strong> {{ $booking->payment_status }}</p>

<hr>
<p><strong>Metode Pembayaran:</strong> {{ $booking->payment_method }}</p>
@if($booking->payment_proof)
    <img src="{{ asset('uploads/'.$booking->payment_proof) }}" width="300">
@endif
</body>
</html>
