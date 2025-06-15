<?php

namespace App\Service;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Collection;

class MooraService
{
    protected $alternatifs;
    protected $kriterias;
    protected $penilaians;
    protected $matriksKeputusan = [];
    protected $matriksNormalisasi = [];
    protected $matriksOptimasi = [];
    protected $hasilPerangkingan = [];
    protected $useCustomData = false;
    protected $customAlternatifs = [];

    public function __construct()
    {
        $this->kriterias = Kriteria::all();
    }

    /**
     * Menjalankan proses perhitungan MOORA dengan data dari database
     */
    public function hitungMoora()
    {
        $this->useCustomData = false;
        $this->alternatifs = Alternatif::all();
        $this->penilaians = Penilaian::all();

        return $this->jalankanPerhitungan();
    }

    /**
     * Menjalankan proses perhitungan MOORA dengan data custom/baru
     */
    public function hitungMooraWithData($alternatifData)
    {
        $this->useCustomData = true;
        $this->customAlternatifs = $alternatifData;

        return $this->jalankanPerhitungan();
    }

    /**
     * Proses perhitungan MOORA yang sebenarnya
     */
    protected function jalankanPerhitungan()
    {
        // Reset arrays
        $this->matriksKeputusan = [];
        $this->matriksNormalisasi = [];
        $this->matriksOptimasi = [];
        $this->hasilPerangkingan = [];

        $this->buatMatriksKeputusan();
        $this->hitungMatriksNormalisasi();
        $this->hitungNilaiOptimasi();
        $this->perangkingan();

        return [
            'matriks_keputusan' => $this->matriksKeputusan,
            'matriks_normalisasi' => $this->matriksNormalisasi,
            'nilai_optimasi' => $this->matriksOptimasi,
            'hasil_perangkingan' => $this->hasilPerangkingan
        ];
    }

    /**
     * Membuat matriks keputusan dari data penilaian
     */
    protected function buatMatriksKeputusan()
    {
        if ($this->useCustomData) {
            // Gunakan data custom
            foreach ($this->customAlternatifs as $index => $alternatif) {
                $nilai = [];

                foreach ($this->kriterias as $kriteria) {
                    $kodeKriteria = $kriteria->kode; // C1, C2, C3, dst.
                    $nilai[$kriteria->id] = $alternatif['nilai'][$kodeKriteria] ?? 0;
                }

                $this->matriksKeputusan[$index] = $nilai;
            }
        } else {
            // Gunakan data dari database (existing logic)
            foreach ($this->alternatifs as $alternatif) {
                $nilai = [];

                foreach ($this->kriterias as $kriteria) {
                    $penilaian = $this->penilaians
                        ->where('alternatif_id', $alternatif->id)
                        ->where('kriteria_id', $kriteria->id)
                        ->first();

                    $nilai[$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
                }

                $this->matriksKeputusan[$alternatif->id] = $nilai;
            }
        }
    }

    /**
     * Menghitung matriks normalisasi dengan rumus X*ij = Xij / sqrt(Σ(Xij)^2)
     */
    protected function hitungMatriksNormalisasi()
    {
        foreach ($this->kriterias as $kriteria) {
            // Menghitung penyebut (sqrt dari jumlah kuadrat)
            $sumSquared = 0;

            foreach ($this->matriksKeputusan as $alternatifKey => $nilaiAlternatif) {
                $nilai = $nilaiAlternatif[$kriteria->id];
                $sumSquared += pow($nilai, 2);
            }

            $pembagi = sqrt($sumSquared);

            // Menghitung nilai normalisasi untuk setiap alternatif
            foreach ($this->matriksKeputusan as $alternatifKey => $nilaiAlternatif) {
                $nilai = $nilaiAlternatif[$kriteria->id];
                $this->matriksNormalisasi[$alternatifKey][$kriteria->id] = $pembagi > 0 ? $nilai / $pembagi : 0;
            }
        }
    }

    /**
     * Menghitung nilai optimasi dengan mengalikan bobot kriteria
     */
    protected function hitungNilaiOptimasi()
    {
        foreach ($this->matriksNormalisasi as $alternatifKey => $nilaiAlternatif) {
            $nilaiOptimasi = 0;

            foreach ($this->kriterias as $kriteria) {
                $nilai = $nilaiAlternatif[$kriteria->id];

                // Mengalikan dengan bobot kriteria
                $nilaiTerbobot = $nilai * $kriteria->bobot;

                if ($kriteria->jenis == 'benefit') {
                    $nilaiOptimasi += $nilaiTerbobot;
                } else {
                    $nilaiOptimasi -= $nilaiTerbobot;
                }
            }

            $this->matriksOptimasi[$alternatifKey] = round($nilaiOptimasi, 5);
        }
    }

    /**
     * Mengurutkan nilai optimasi dari tertinggi ke terendah
     */
    protected function perangkingan()
    {
        if ($this->useCustomData) {
            // Handle custom data
            $dataPerangkingan = collect($this->matriksOptimasi)
                ->map(function ($nilai, $index) {
                    $alternatif = $this->customAlternatifs[$index];
                    return [
                        'alternatif_id' => $index,
                        'kode' => 'A' . ($index + 1), // Generate kode A1, A2, A3, dst.
                        'nama' => $alternatif['nama'],
                        'nilai_optimasi' => $nilai
                    ];
                })
                ->sortByDesc('nilai_optimasi')
                ->values()
                ->toArray();
        } else {
            // Handle database data (existing logic)
            $dataPerangkingan = collect($this->matriksOptimasi)
                ->map(function ($nilai, $alternatifId) {
                    $alternatif = $this->alternatifs->find($alternatifId);
                    return [
                        'alternatif_id' => $alternatifId,
                        'kode' => $alternatif->kode,
                        'nama' => $alternatif->nama,
                        'nilai_optimasi' => $nilai
                    ];
                })
                ->sortByDesc('nilai_optimasi')
                ->values()
                ->toArray();
        }

        // Tambahkan peringkat
        $rank = 1;
        foreach ($dataPerangkingan as $key => $data) {
            $dataPerangkingan[$key]['rank'] = $rank++;
        }

        $this->hasilPerangkingan = $dataPerangkingan;
    }

    /**
     * Get daftar kriteria (untuk debugging atau keperluan lain)
     */
    public function getKriterias()
    {
        return $this->kriterias;
    }

    /**
     * Get matriks keputusan (untuk debugging)
     */
    public function getMatriksKeputusan()
    {
        return $this->matriksKeputusan;
    }
}
