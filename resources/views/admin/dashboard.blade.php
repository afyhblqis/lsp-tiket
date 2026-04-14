<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
</head>

<body>
    <h2>Panel Admin - Manajemen E-Ticket</h2>

    <nav>
        <strong>Menu:</strong>
        <a href="/admin/schedules/create"> Tambah Jadwal Baru</a> |
        <a href="/logout">Logout</a>
    </nav>
    <hr>

    <h3>1. Daftar Jadwal Pesawat</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr style="background-color: #eee;">
                <th>Pesawat</th>
                <th>Rute</th>
                <th>Keberangkatan</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $s)
                <tr>
                    <td>{{ $s->plane_name }}</td>
                    <td>{{ $s->origin }} -> {{ $s->destination }}</td>
                    <td>{{ $s->departure }}</td>
                    <td>Rp {{ number_format($s->price) }}</td>
                    <td>{{ $s->stock }}</td>
                    <td>
                        <a href="/admin/schedules/edit/{{ $s->id }}">Edit</a> |
                        <a href="/admin/schedules/delete/{{ $s->id }}"
                           onclick="return confirm('Hapus jadwal ini?')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <h3>2. Riwayat Transaksi (Semua User)</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr style="background-color: #eee;">
                <th>ID</th>
                <th>Nama Pemesan</th>
                <th>Pesawat</th>
                <th>Jumlah Kursi</th>
                <th>Total Bayar</th>
                <th>Waktu Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->user->name }}</td>
                    <td>{{ $b->schedule->plane_name }}</td>
                    <td>{{ $b->total_seats }}</td>
                    <td>Rp {{ number_format($b->total_price) }}</td>
                    <td>{{ $b->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($b->payment_status == 'pending')
                            <a href="/admin/bookings/approve/{{ $b->id }}">✅ Approve</a> |
                            <a href="/admin/bookings/reject/{{ $b->id }}">❌ Reject</a>
                        @else
                            <span>{{ $b->payment_status }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($schedules->isEmpty() && $bookings->isEmpty())
        <p>Belum ada data untuk ditampilkan.</p>
    @endif

</body>

</html>
