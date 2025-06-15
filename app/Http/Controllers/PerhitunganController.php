<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MooraService;
use App\Models\HasilPerhitungan;
use Illuminate\Support\Facades\Auth;

class PerhitunganController extends Controller
{
    protected $mooraService;

    public function __construct(MooraService $mooraService)
    {
        $this->mooraService = $mooraService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Admin bisa lihat semua perhitungan
        $hasilPerhitungans = HasilPerhitungan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('perhitungan.index', compact('hasilPerhitungans'));
    }

    /**
     * Calculate using MOORA method
     */
    public function calculate(Request $request)
    {
        // Validate request
        $request->validate([
            'nama_perhitungan' => 'required|string|max:255',
        ]);

        // Run MOORA calculation
        $hasil = $this->mooraService->hitungMoora();

        // Sort data naturally before saving
        $sortedData = $this->sortDataNaturally($hasil);

        // Save the result
        HasilPerhitungan::create([
            'nama_perhitungan' => $request->nama_perhitungan,
            'user_id' => Auth::id(),
            'data_perhitungan' => [
                'matriks_keputusan' => $sortedData['matriks_keputusan'],
                'matriks_normalisasi' => $sortedData['matriks_normalisasi'],
                'nilai_optimasi' => $sortedData['nilai_optimasi']
            ],
            'hasil_perangkingan' => $sortedData['hasil_perangkingan']
        ]);

        return redirect()->route('perhitungan.index')
            ->with('success', 'Perhitungan MOORA berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hasil = HasilPerhitungan::with('user')->findOrFail($id);

        return view('perhitungan.detail', compact('hasil'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hasil = HasilPerhitungan::findOrFail($id);

        $hasil->delete();

        return redirect()->route('perhitungan.index')
            ->with('delete_success', 'Hasil perhitungan berhasil dihapus');
    }

    public function cetak($id)
    {
        $perhitungan = HasilPerhitungan::with('user')->findOrFail($id);

        return view('perhitungan.cetak', [
            'perhitungan' => $perhitungan
        ]);
    }

    /**
     * Sort data naturally by alternative code
     */
    private function sortDataNaturally($hasil)
    {
        // Sort matriks_keputusan
        if (isset($hasil['matriks_keputusan'])) {
            $hasil['matriks_keputusan'] = $this->sortByAlternativeCode($hasil['matriks_keputusan']);
        }

        // Sort matriks_normalisasi
        if (isset($hasil['matriks_normalisasi'])) {
            $hasil['matriks_normalisasi'] = $this->sortByAlternativeCode($hasil['matriks_normalisasi']);
        }

        // Sort nilai_optimasi
        if (isset($hasil['nilai_optimasi'])) {
            $hasil['nilai_optimasi'] = $this->sortByAlternativeCode($hasil['nilai_optimasi']);
        }

        // Sort hasil_perangkingan
        if (isset($hasil['hasil_perangkingan'])) {
            $hasil['hasil_perangkingan'] = collect($hasil['hasil_perangkingan'])
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

    /**
     * Sort array by alternative code naturally
     */
    private function sortByAlternativeCode($data)
    {
        return collect($data)
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
    }
}
