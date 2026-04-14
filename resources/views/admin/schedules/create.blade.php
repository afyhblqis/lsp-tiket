<html>
<head>
    <title>Tambah Jadwal Baru</title>
</head>
<body>
    <h2>Tambah Jadwal Penerbangan Baru</h2>
    <a href="/dashboard"><- Kembali ke Dashboard</a>
    <hr>

    <form action="/admin/schedules/store" method="POST">
        @csrf

        <label>Nama Pesawat:</label><br>
        <input type="text" name="plane_name" placeholder="Contoh: Garuda Indonesia GA-123" required style="width: 300px;">
        <br><br>

        <label>Asal (Origin):</label><br>
        <input type="text" name="origin" placeholder="Contoh: Jakarta (CGK)" required>
        <br><br>

        <label>Tujuan (Destination):</label><br>
        <input type="text" name="destination" placeholder="Contoh: Bali (DPS)" required>
        <br><br>

        <label>Waktu Keberangkatan:</label><br>
        <input type="datetime-local" name="departure" required>
        <br><br>

        <label>Harga per Tiket:</label><br>
        <input type="number" name="price" placeholder="Contoh: 1500000" required>
        <br><br>

        <label>Stok Kursi:</label><br>
        <input type="number" name="stock" placeholder="Contoh: 50" required>
        <br><br>

        <button type="submit">Simpan Jadwal</button>
    </form>
</body>
</html>
