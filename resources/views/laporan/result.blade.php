@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 space-y-6">

    <h2 class="text-2xl font-semibold">Hasil Laporan</h2>

    {{-- CARD RINGKASAN --}}
    <div class="grid grid-cols-3 gap-5">
        <div class="bg-green-100 p-5 rounded-lg border border-green-300">
            <p class="text-sm text-gray-600">Total Pemasukan</p>
            <h3 class="text-xl font-bold text-green-700">
                Rp {{ number_format($total_pemasukan) }}
            </h3>
        </div>

        <div class="bg-red-100 p-5 rounded-lg border border-red-300">
            <p class="text-sm text-gray-600">Total Pengeluaran</p>
            <h3 class="text-xl font-bold text-red-700">
                Rp {{ number_format($total_pengeluaran) }}
            </h3>
        </div>

        <div class="bg-blue-100 p-5 rounded-lg border border-blue-300">
            <p class="text-sm text-gray-600">Saldo</p>
            <h3 class="text-xl font-bold text-blue-700">
                Rp {{ number_format($total_pemasukan - $total_pengeluaran) }}
            </h3>
        </div>
    </div>

    {{-- EXPORT BUTTON --}}
    <div class="flex gap-3">
        <a href="{{ route('laporan.export.pdf', ['start'=>request('start_date'), 'end'=>request('end_date')]) }}"
            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            Export PDF
        </a>

        <a href="{{ route('laporan.export.excel', ['start'=>request('start_date'), 'end'=>request('end_date')]) }}"
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Export Excel
        </a>
    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Deskripsi</th>
                    <th class="p-3">Tipe</th>
                    <th class="p-3">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr class="border-b">
                    <td class="p-3">{{ $row->tanggal }}</td>
                    <td class="p-3">{{ $row->kategori->nama }}</td>
                    <td class="p-3">{{ $row->deskripsi }}</td>
                    <td class="p-3 capitalize">{{ $row->tipe }}</td>
                    <td class="p-3">Rp {{ number_format($row->jumlah) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection