<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Pemesanan</title>
</head>

<body>
    <h2>Riwayat Pemesanan Tiket Anda</h2>
    <a href="/dashboard"><- Kembali ke Dashboard</a>
    <hr>

    @if ($orders->isEmpty())
        <p>Anda belum memiliki riwayat pemesanan.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Pesawat</th>
                    <th>Rute</th>
                    <th>Kursi</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th> <!-- TAMBAHAN -->
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr>
                        <td>{{ $item->schedule->plane_name }}</td>
                        <td>{{ $item->schedule->origin }} ke {{ $item->schedule->destination }}</td>
                        <td>{{ $item->total_seats }}</td>
                        <td>Rp {{ number_format($item->total_price) }}</td>
                        <td>
                                @if($item->payment_status == 'pending')
                                    Menunggu Verifikasi
                                @elseif($item->payment_status == 'approved')
                                    Disetujui
                                @else
                                    Ditolak
                                @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/booking/detail/{{ $item->id }}">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
