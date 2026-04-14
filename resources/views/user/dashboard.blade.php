<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
</head>
<body>
    <h2>Selamat Datang, {{ auth()->user()->name }}</h2>

    <nav>
        <a href="/history">Riwayat Pemesanan</a> |
        <a href="/logout">Logout</a>
    </nav>
    <hr>

    <h3>Jadwal Penerbangan Tersedia</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Pesawat</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Keberangkatan</th>
                <th>Harga</th>
                <th>Sisa Kursi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($schedules as $item)
                <tr>
                    <td>{{ $item->plane_name }}</td>
                    <td>{{ $item->origin }}</td>
                    <td>{{ $item->destination }}</td>
                    <td>{{ $item->departure }}</td>
                    <td>Rp {{ number_format($item->price) }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <a href="/booking/{{ $item->id }}">Pesan</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($schedules->isEmpty())
        <p>Maaf, saat ini tidak ada jadwal penerbangan yang tersedia.</p>
    @endif
</body>
</html>
