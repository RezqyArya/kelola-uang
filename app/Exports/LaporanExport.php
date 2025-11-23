<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end   = $end;
    }

    public function view(): View
    {
        $data = Transaksi::with('kategori')
            ->where('user_id', auth()->id())
            ->whereBetween('tanggal', [$this->start, $this->end])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('laporan.excel', compact('data'));
    }
}