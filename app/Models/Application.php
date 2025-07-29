<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_aplikasi',
        'unit_id',
        'versi',
        'masa_berlaku',
        'status',
        'harga',
        'tanggal_pembelian',
        'lokasi_pembelian_id',
        'deskripsi',
        'bukti_pembelian',
    ];

    protected $dates = [
        'masa_berlaku',
        'tanggal_pembelian',
    ];

    // Opsional: accessor untuk menghitung sisa hari
    public function getSisaHariAttribute()
    {
        if ($this->masa_berlaku) {
            return Carbon::now()->diffInDays($this->masa_berlaku, false);
        }

        return null;
    }

    // Opsional: helper apakah akan habis dalam 30 hari
    public function getAkanHabisAttribute()
    {
        return $this->masa_berlaku && $this->masa_berlaku->isBetween(now(), now()->addDays(30));
    }

    public function unit()
{
    return $this->belongsTo(Unit::class, 'unit_id');
}

public function lokasiPembelian()
{
    return $this->belongsTo(LokasiPembelian::class);
}
}
