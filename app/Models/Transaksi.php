<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'tipe',
        'deskripsi',
        'tanggal',
        'jumlah',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}