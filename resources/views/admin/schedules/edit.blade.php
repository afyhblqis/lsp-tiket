<body>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #4facfe;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            margin: 15px 0 25px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        input:focus {
            border-color: #4facfe;
            outline: none;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ffc107;
            border: none;
            border-radius: 8px;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #e0a800;
        }

        .back {
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>

    <div class="container">
        <h2>✏️ Edit Jadwal Penerbangan</h2>

        <a href="/dashboard" class="back">← Kembali ke Dashboard</a>
        <hr>

        <form action="/admin/schedules/update/{{ $schedule->id }}" method="POST">
            @csrf

            <label>Nama Pesawat:</label>
            <input type="text" name="plane_name" value="{{ $schedule->plane_name }}" required>

            <label>Asal (Origin):</label>
            <input type="text" name="origin" value="{{ $schedule->origin }}" required>

            <label>Tujuan (Destination):</label>
            <input type="text" name="destination" value="{{ $schedule->destination }}" required>

            <label>Waktu Keberangkatan:</label>
            <input type="datetime-local" name="departure"
                   value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure)) }}" required>

            <label>Harga per Tiket:</label>
            <input type="number" name="price" value="{{ $schedule->price }}" required>

            <label>Stok Kursi:</label>
            <input type="number" name="stock" value="{{ $schedule->stock }}" required>

            <button type="submit">✏️ Update Jadwal</button>
        </form>
    </div>

</body>
