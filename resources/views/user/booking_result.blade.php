<!DOCTYPE html>
<html>
<head>
    <title>Detail Booking</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }
        .card {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            display: inline-block;
        }
        .pending { background: orange; }
        .verif { background: blue; }
        .success { background: green; }
        img {
            margin-top: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Detail Booking</h2>

    <a href="/history">← Kembali</a>

    <hr>

    <p><strong>Pesawat:</strong> {{ $booking->schedule->plane_name }}</p>
    <p><strong>Rute:</strong> {{ $booking->schedule->origin }} → {{ $booking->schedule->destination }}</p>
    <p><strong>Waktu:</strong> {{ $booking->schedule->departure }}</p>

    <hr>

    <p><strong>Jumlah Kursi:</strong> {{ $booking->total_seats }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_price) }}</p>

    <hr>

    <p><strong>Metode Pembayaran:</strong> {{ $booking->payment_method ?? '-' }}</p>

    <p><strong>Status:</strong>
        @if($booking->payment_status == 'pending')
    <span class="status pending">Belum Bayar</span>
@elseif($booking->payment_status == 'waiting_verification')
    <span class="status verif">Menunggu Verifikasi</span>
@elseif($booking->payment_status == 'approved')
    <span class="status success">Disetujui</span>
@else
    <span class="status pending">Unknown</span>
@endif
    </p>

    <hr>

    @if($booking->payment_proof)
        <p><strong>Bukti Pembayaran:</strong></p>
        <img src="{{ asset('uploads/'.$booking->payment_proof) }}" width="100%">
    @else
        <p><i>Belum upload bukti pembayaran</i></p>
    @endif

</div>

</body>
</html>
