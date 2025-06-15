<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'bobot',
        'jenis',
    ];

    /**
     * Get the subkriteria for the kriteria.
     */
    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }

    /**
     * Get the penilaian for the kriteria.
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
