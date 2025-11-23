<?php

namespace App\Http\Controllers;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function show(Request $r)
    {
        $periode   = $r->periode;
        $startDate = $r->start_date;
        $endDate   = $r->end_date;

        $query = Transaksi::with('kategori')
            ->where('user_id', auth()->id());

        if ($periode === 'harian') {
            $query->whereDate('tanggal', now());
        } elseif ($periode === 'bulanan') {
            $query->whereMonth('tanggal', now()->month)
                  ->whereYear('tanggal', now()->year);
        } elseif ($periode === 'tahunan') {
            $query->whereYear('tanggal', now()->year);
        } elseif ($periode === 'custom' && $startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $data = $query->orderBy('tanggal', 'asc')->get();

        $total_pemasukan   = $data->where('tipe', 'pemasukan')->sum('jumlah');
        $total_pengeluaran = $data->where('tipe', 'pengeluaran')->sum('jumlah');

        return view('laporan.result', compact('data', 'total_pemasukan', 'total_pengeluaran'));
    }

    public function exportPDF(Request $r)
    {
        $data = Transaksi::with('kategori')
            ->where('user_id', auth()->id())
            ->whereBetween('tanggal', [$r->start, $r->end])
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = PDF::loadView('laporan.pdf', compact('data'));
        return $pdf->download('laporan-keuangan.pdf');
    }

    public function exportExcel(Request $r)
    {
        return Excel::download(
            new LaporanExport($r->start, $r->end),
            'laporan-keuangan.xlsx'
        );
    }
}