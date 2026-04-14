<body>
    <h2>Edit Jadwal Penerbangan</h2>
    <a href="/dashboard"><- Kembali ke Dashboard</a>
    <hr>

    <form action="/admin/schedules/update/{{ $schedule->id }}" method="POST">
        @csrf
        {{-- Di Laravel, untuk update data kita mengirim data lewat POST --}}

        <label>Nama Pesawat:</label><br>
        <input type="text" name="plane_name" value="{{ $schedule->plane_name }}" required style="width: 300px;">
        <br><br>

        <label>Asal (Origin):</label><br>
        <input type="text" name="origin" value="{{ $schedule->origin }}" required>
        <br><br>

        <label>Tujuan (Destination):</label><br>
        <input type="text" name="destination" value="{{ $schedule->destination }}" required>
        <br><br>

        <label>Waktu Keberangkatan:</label><br>
        {{-- Format waktu untuk datetime-local harus Y-m-d\TH:i --}}
        <input type="datetime-local" name="departure"
               value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure)) }}" required>
        <br><br>

        <label>Harga per Tiket:</label><br>
        <input type="number" name="price" value="{{ $schedule->price }}" required>
        <br><br>

        <label>Stok Kursi:</label><br>
        <input type="number" name="stock" value="{{ $schedule->stock }}" required>
        <br><br>

        <button type="submit">Update Jadwal</button>
    </form>
</body>
