<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan</title>
</head>
<body>
    <h2>Konfirmasi Pemesanan Tiket</h2>
    <a href="/dashboard">← Kembali ke Jadwal</a>
    <hr>

    <h3>Rincian Pesawat</h3>
    <p><strong>Nama Pesawat:</strong> {{ $schedule->plane_name }}</p>
    <p><strong>Rute:</strong> {{ $schedule->origin }} ke {{ $schedule->destination }}</p>
    <p><strong>Waktu Berangkat:</strong> {{ $schedule->departure }}</p>
    <p><strong>Harga per Kursi:</strong> Rp {{ number_format($schedule->price) }}</p>
    <p><strong>Stok Tersedia:</strong> {{ $schedule->stock }} kursi</p>

    <hr>

    <form action="/booking/{{ $schedule->id }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Jumlah Kursi:</label><br>
    <input type="number" name="total_seats" min="1" max="{{ $schedule->stock }}" required id="input_kursi">

    <br><br>

    <label>Metode Pembayaran:</label><br>
    <select name="payment_method" required>
        <option value="">-- Pilih Bank --</option>
        <option value="BCA">BCA</option>
        <option value="Mandiri">Mandiri</option>
        <option value="BRI">BRI</option>
        <option value="BNI">BNI</option>
    </select>

    <br><br>

    <label>Upload Bukti Pembayaran:</label><br>
    <input type="file" name="payment_proof" required>

    <br><br>

    <p><strong>Total Harga:</strong> <span id="total_harga">0</span></p>

    <button type="submit">Konfirmasi & Pesan</button>
</form>

    <script>
    const inputKursi = document.getElementById('input_kursi');
    const displayTotal = document.getElementById('total_harga');
    const hargaSatuan = {{ $schedule->price }};

    inputKursi.addEventListener('input', function() {
        const jumlah = inputKursi.value;
        const total = jumlah * hargaSatuan;

        // Format ke rupiah sederhana
        displayTotal.innerText = "Rp " + total.toLocaleString();
    });
    </script>
</body>
</html>
