<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan</title>

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

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 0;
        }

        .info {
            margin: 8px 0;
            font-size: 14px;
        }

        .route {
            font-size: 18px;
            font-weight: bold;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: green;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        .total {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .btn:hover {
            background: #3a8ee6;
        }

        .back {
            display: inline-block;
            margin-top: 10px;
            color: #4facfe;
            text-decoration: none;
        }
    </style>
</head>

<body>

<header>
    <h2>Konfirmasi Pemesanan</h2>
    <nav>
        <a href="/dashboard">Dashboard</a>
        <a href="/history">Riwayat</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<div class="container">

    <!-- DETAIL TIKET -->
    <div class="card">

        <div class="route">
            ✈️ {{ $schedule->origin }} → {{ $schedule->destination }}
        </div>

        <div class="info">
            Pesawat: {{ $schedule->plane_name }}
        </div>

        <div class="info">
            Berangkat: {{ $schedule->departure }}
        </div>

        <div class="info">
            Sisa Kursi: {{ $schedule->stock }}
        </div>

        <div class="price">
            Rp {{ number_format($schedule->price) }} / kursi
        </div>

    </div>

    <!-- FORM -->
    <div class="card">

        <h3>🎟️ Pesan Tiket</h3>

        <form action="/booking/{{ $schedule->id }}" method="POST">
            @csrf

            <label>Jumlah Kursi</label>
            <input type="number" name="total_seats" min="1" max="{{ $schedule->stock }}" required id="input_kursi">

            <div class="total">
                Total Harga:
                <span id="total_harga">Rp 0</span>
            </div>

            <button type="submit" class="btn">
                Pesan Sekarang
            </button>
        </form>

        <a href="/dashboard" class="back">← Kembali ke Jadwal</a>

    </div>

</div>

<script>
const inputKursi = document.getElementById('input_kursi');
const displayTotal = document.getElementById('total_harga');
const hargaSatuan = {{ $schedule->price }};

inputKursi.addEventListener('input', function() {
    const jumlah = inputKursi.value;
    const total = jumlah * hargaSatuan;

    displayTotal.innerText = "Rp " + total.toLocaleString();
});
</script>

</body>
</html>
