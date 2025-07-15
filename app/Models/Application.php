<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_aplikasi',
        'versi',
        'kategori',
        'status',
        'harga',
        'tanggal_pembelian',
        'lokasi_pembelian',
        'deskripsi',
        'bukti_pembelian',
    ];
}