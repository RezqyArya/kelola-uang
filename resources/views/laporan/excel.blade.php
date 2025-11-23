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
            <td>{{ $d->jumlah }}</td>
        </tr>
        @endforeach
    </tbody>
</table>