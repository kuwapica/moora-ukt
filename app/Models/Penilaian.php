<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai',
    ];

    /**
     * Get the alternatif that owns the penilaian.
     */
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    /**
     * Get the kriteria that owns the penilaian.
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
