<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h3>Laporan Keuangan</h3>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Tipe</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->tanggal }}</td>
            <td>{{ $d->kategori->nama }}</td>
            <td>{{ $d->deskripsi }}</td>
            <td>{{ ucfirst($d->tipe) }}</td>
            <td>Rp {{ number_format($d->jumlah) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>