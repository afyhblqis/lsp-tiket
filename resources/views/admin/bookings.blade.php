<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Pembayaran</title>
</head>
<body>

<h2>Data Booking</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Pesawat</th>
        <th>Kursi</th>
        <th>Total</th>
        <th>Metode</th>
        <th>Bukti</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($bookings as $item)
    <tr>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->schedule->plane_name }}</td>
        <td>{{ $item->total_seats }}</td>
        <td>Rp {{ number_format($item->total_price) }}</td>
        <td>{{ $item->payment_method }}</td>

        <td>
            @if($item->payment_proof)
                <img src="{{ asset('uploads/'.$item->payment_proof) }}" width="100">
            @endif
        </td>

        <td>{{ $item->payment_status }}</td>

        <td>
            <a href="/admin/bookings/approve/{{ $item->id }}">✅ Approve</a>
            |
            <a href="/admin/bookings/reject/{{ $item->id }}">❌ Reject</a>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>
