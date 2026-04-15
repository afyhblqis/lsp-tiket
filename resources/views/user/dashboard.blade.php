<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>

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

        nav {
            margin-top: 5px;
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

        .grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .route {
            font-size: 18px;
            font-weight: bold;
        }

        .plane {
            color: #555;
            margin-bottom: 10px;
        }

        .info {
            font-size: 14px;
            margin: 5px 0;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #4facfe;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn:hover {
            background: #3a8ee6;
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
    <h2>Halo, {{ auth()->user()->name }} 👋</h2>
    <nav>
        <a href="/history">Riwayat</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<div class="container">

    <h3>✈️ Jadwal Penerbangan</h3>

    @if($schedules->isEmpty())
        <p class="empty">Tidak ada jadwal tersedia.</p>
    @else

        <div class="grid">
            @foreach($schedules as $item)

                <div class="card">

                    <div class="plane">
                        ✈️ {{ $item->plane_name }}
                    </div>

                    <div class="route">
                        {{ $item->origin }} → {{ $item->destination }}
                    </div>

                    <div class="info">
                        🕒 {{ $item->departure }}
                    </div>

                    <div class="info">
                        💺 Sisa Kursi: {{ $item->stock }}
                    </div>

                    <div class="price">
                        Rp {{ number_format($item->price) }}
                    </div>

                    <a href="/booking/{{ $item->id }}" class="btn">
                        Pesan Sekarang
                    </a>

                </div>

            @endforeach
        </div>

    @endif

</div>

</body>
</html>
