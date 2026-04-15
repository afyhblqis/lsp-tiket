<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        header {
            background: #4facfe;
            color: white;
            padding: 15px 30px;
        }

        header h2 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        h3 {
            margin-top: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background: #4facfe;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background: #f1f1f1;
        }

        .btn {
            padding: 5px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn-approve {
            background: #28a745;
        }

        .btn-reject {
            background: #dc3545;
        }

        .status {
            font-weight: bold;
        }
    </style>

</head>

<body>

    <header>
        <h2>Panel Admin - Manajemen E-Ticket</h2>
        <nav>
            <a href="/admin/schedules/create">+ Tambah Jadwal</a>
            <a href="/logout">Logout</a>
        </nav>
    </header>

    <div class="container">

        <div class="card">
            <h3>✈️ Daftar Jadwal Pesawat</h3>
            <table>
                <thead>
                    <tr>
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
                            <td>{{ $s->origin }} → {{ $s->destination }}</td>
                            <td>{{ $s->departure }}</td>
                            <td>Rp {{ number_format($s->price) }}</td>
                            <td>{{ $s->stock }}</td>
                            <td>
                                <a href="/admin/schedules/edit/{{ $s->id }}" class="btn btn-edit">Edit</a>
                                <a href="/admin/schedules/delete/{{ $s->id }}"
                                   class="btn btn-delete"
                                   onclick="return confirm('Hapus jadwal ini?')">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>💳 Riwayat Transaksi</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Pesawat</th>
                        <th>Kursi</th>
                        <th>Total</th>
                        <th>Waktu</th>
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
                                @if($b->payment_status == 'waiting_verification')
                                    <a href="/admin/bookings/approve/{{ $b->id }}" class="btn btn-approve">Approve</a>
                                    <a href="/admin/bookings/reject/{{ $b->id }}" class="btn btn-reject">Reject</a>
                                @else
                                    <span class="status">{{ $b->payment_status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($schedules->isEmpty() && $bookings->isEmpty())
            <p>Belum ada data untuk ditampilkan.</p>
        @endif

    </div>

</body>

</html>
