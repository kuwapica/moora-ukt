<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'keterangan',
        'nilai',
    ];

    /**
     * Get the kriteria that owns the subkriteria.
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
