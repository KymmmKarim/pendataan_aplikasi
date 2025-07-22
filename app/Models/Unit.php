<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'nama',
        'singkatan',
        'urut',
        'parent_id',
        'aktif',
    ];

    // Relasi ke unit induk
    public function parent()
    {
        return $this->belongsTo(Unit::class, 'parent_id');
    }

    // Relasi ke unit anak
    public function children()
    {
        return $this->hasMany(Unit::class, 'parent_id');
    }
}