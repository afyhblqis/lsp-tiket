<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>

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
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .info {
            margin: 8px 0;
            font-size: 14px;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: green;
        }

        /* PAYMENT METHOD CARD */
        .payment-grid {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .payment-card {
            flex: 1;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .payment-card:hover {
            border-color: #4facfe;
        }

        .active {
            border-color: #4facfe;
            background: #eaf4ff;
        }

        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }

        .btn {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .rekening-box {
            margin-top: 10px;
            padding: 10px;
            border-radius: 8px;
            background: #f1f1f1;
            font-size: 14px;
        }

    </style>
</head>

<body>

<header>
    <h2>Pembayaran Tiket</h2>
    <nav>
        <a href="/dashboard">Dashboard</a>
        <a href="/history">Riwayat</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<div class="container">

    <!-- DETAIL -->
    <div class="card">
        <h3>✈️ Detail Booking</h3>

        <div class="info"><strong>Pesawat:</strong> {{ $booking->schedule->plane_name }}</div>
        <div class="info"><strong>Rute:</strong> {{ $booking->schedule->origin }} → {{ $booking->schedule->destination }}</div>
        <div class="info"><strong>Berangkat:</strong> {{ $booking->schedule->departure }}</div>
        <div class="info"><strong>Kursi:</strong> {{ $booking->total_seats }}</div>

        <div class="price">
            Total: Rp {{ number_format($booking->total_price) }}
        </div>
    </div>

    <!-- PEMBAYARAN -->
    <div class="card">
        <h3>💳 Pilih Metode Pembayaran</h3>

        <form action="{{ route('payment.upload', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- hidden input -->
            <input type="hidden" name="payment_method" id="payment_method">

            <!-- CARD PAYMENT -->
            <div class="payment-grid">

                <div class="payment-card" onclick="selectPayment('BCA', this)">
                    BCA
                </div>

                <div class="payment-card" onclick="selectPayment('Mandiri', this)">
                    Mandiri
                </div>

                <div class="payment-card" onclick="selectPayment('BRI', this)">
                    BRI
                </div>

                <div class="payment-card" onclick="selectPayment('BNI', this)">
                    BNI
                </div>

            </div>

            <!-- REKENING -->
            <div id="rekening_info" class="rekening-box"></div>

            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="payment_proof" required>

            <button type="submit" class="btn">
                Kirim Bukti Pembayaran
            </button>

        </form>
    </div>

</div>

<script>
function selectPayment(method, element) {
    // set value ke input hidden
    document.getElementById('payment_method').value = method;

    // remove active semua
    document.querySelectorAll('.payment-card').forEach(el => el.classList.remove('active'));

    // tambahkan active ke yang dipilih
    element.classList.add('active');

    // tampilkan rekening
    let html = "";

    if (method === "BCA") {
        html = "BCA - 123456789<br>a.n PT TiketKu";
    } else if (method === "Mandiri") {
        html = "Mandiri - 987654321<br>a.n PT TiketKu";
    } else if (method === "BRI") {
        html = "BRI - 456123789<br>a.n PT TiketKu";
    } else if (method === "BNI") {
        html = "BNI - 321654987<br>a.n PT TiketKu";
    }

    document.getElementById('rekening_info').innerHTML = html;
}
</script>

</body>
</html>
