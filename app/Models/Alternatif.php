<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
    ];

    /**
     * Get the penilaian for the alternatif.
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Get a specific penilaian by kriteria_id
     */
    public function getNilaiKriteria($kriteria_id)
    {
        $penilaian = $this->penilaians()->where('kriteria_id', $kriteria_id)->first();
        return $penilaian ? $penilaian->nilai : 0;
    }
}
