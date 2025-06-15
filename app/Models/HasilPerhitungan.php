<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilPerhitungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perhitungan',
        'user_id',
        'data_perhitungan',
        'hasil_perangkingan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_perhitungan' => 'array',
        'hasil_perangkingan' => 'array',
    ];

    /**
     * Get the user that owns the hasil perhitungan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get sorted data perhitungan with natural ordering for alternative codes
     */
    public function getSortedDataPerhitunganAttribute()
    {
        $data = $this->data_perhitungan;

        if (isset($data['nilai_optimasi'])) {
            // Sort nilai_optimasi by alternative code naturally
            $sortedNilaiOptimasi = collect($data['nilai_optimasi'])
                ->map(function ($nilai, $alternatifId) {
                    $alternatif = \App\Models\Alternatif::find($alternatifId);
                    return [
                        'alternatif_id' => $alternatifId,
                        'kode' => $alternatif ? $alternatif->kode : '',
                        'nilai' => $nilai
                    ];
                })
                ->sortBy(function ($item) {
                    // Natural sort for codes like A1, A2, ..., A10
                    if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                        return $matches[1] . sprintf('%03d', (int)$matches[2]);
                    }
                    return $item['kode'];
                })
                ->pluck('nilai', 'alternatif_id')
                ->toArray();

            $data['nilai_optimasi'] = $sortedNilaiOptimasi;
        }

        if (isset($data['matriks_keputusan'])) {
            // Sort matriks_keputusan by alternative code naturally
            $sortedMatriksKeputusan = collect($data['matriks_keputusan'])
                ->map(function ($nilai, $alternatifId) {
                    $alternatif = \App\Models\Alternatif::find($alternatifId);
                    return [
                        'alternatif_id' => $alternatifId,
                        'kode' => $alternatif ? $alternatif->kode : '',
                        'nilai' => $nilai
                    ];
                })
                ->sortBy(function ($item) {
                    if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                        return $matches[1] . sprintf('%03d', (int)$matches[2]);
                    }
                    return $item['kode'];
                })
                ->pluck('nilai', 'alternatif_id')
                ->toArray();

            $data['matriks_keputusan'] = $sortedMatriksKeputusan;
        }

        if (isset($data['matriks_normalisasi'])) {
            // Sort matriks_normalisasi by alternative code naturally
            $sortedMatriksNormalisasi = collect($data['matriks_normalisasi'])
                ->map(function ($nilai, $alternatifId) {
                    $alternatif = \App\Models\Alternatif::find($alternatifId);
                    return [
                        'alternatif_id' => $alternatifId,
                        'kode' => $alternatif ? $alternatif->kode : '',
                        'nilai' => $nilai
                    ];
                })
                ->sortBy(function ($item) {
                    if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                        return $matches[1] . sprintf('%03d', (int)$matches[2]);
                    }
                    return $item['kode'];
                })
                ->pluck('nilai', 'alternatif_id')
                ->toArray();

            $data['matriks_normalisasi'] = $sortedMatriksNormalisasi;
        }

        return $data;
    }

    /**
     * Get sorted hasil perangkingan with natural ordering for alternative codes
     */
    public function getSortedHasilPerangkinganAttribute()
    {
        $hasil = $this->hasil_perangkingan;

        if (is_array($hasil)) {
            return collect($hasil)
                ->sortBy(function ($item) {
                    // Sort by rank first, then by code naturally
                    $rank = isset($item['rank']) ? sprintf('%03d', $item['rank']) : '999';

                    if (isset($item['kode']) && preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                        $naturalCode = $matches[1] . sprintf('%03d', (int)$matches[2]);
                    } else {
                        $naturalCode = isset($item['kode']) ? $item['kode'] : '';
                    }

                    return $rank . '_' . $naturalCode;
                })
                ->values()
                ->toArray();
        }

        return $hasil;
    }
}
