<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pemesanan</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        header {
            background: #4facfe;
            color: white;
            padding: 15px 30px;
        }

        header h2 {
            margin: 0;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            padding: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }

        .route {
            font-weight: bold;
            font-size: 16px;
        }

        .info {
            font-size: 14px;
            margin: 5px 0;
        }

        .status {
            padding: 5px 10px;
            border-radius: 6px;
            color: white;
            font-size: 12px;
        }

        .waiting { background: orange; }
        .approved { background: green; }
        .rejected { background: red; }
        .pending { background: gray; }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            background: #4facfe;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
        }

        .empty {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }
    </style>
</head>

<body>

<header>
    <h2>Riwayat Pemesanan</h2>
    <nav>
        <a href="/dashboard">Dashboard</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<div class="container">

@if ($orders->isEmpty())
    <p class="empty">Anda belum memiliki riwayat pemesanan.</p>
@else

    @foreach ($orders as $item)

        <div class="card">

            <div class="route">
                ✈️ {{ $item->schedule->origin }} → {{ $item->schedule->destination }}
            </div>

            <div class="info">
                Pesawat: {{ $item->schedule->plane_name }}
            </div>

            <div class="info">
                Kursi: {{ $item->total_seats }}
            </div>

            <div class="info">
                Total: Rp {{ number_format($item->total_price) }}
            </div>

            <div class="info">
                Tanggal: {{ $item->created_at->format('d M Y') }}
            </div>

            <div class="info">
                Status:
                @if($item->payment_status == 'waiting_verification')
                    <span class="status waiting">Menunggu</span>

                @elseif($item->payment_status == 'approved')
                    <span class="status approved">Disetujui</span>

                @elseif($item->payment_status == 'rejected')
                    <span class="status rejected">Ditolak</span>

                @else
                    <span class="status pending">Belum Bayar</span>
                @endif
            </div>

            <a href="/booking/detail/{{ $item->id }}" class="btn">
                Lihat Detail
            </a>

        </div>

    @endforeach

@endif

</div>

</body>
</html>
