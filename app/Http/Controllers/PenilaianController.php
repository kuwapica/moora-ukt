<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatifs = Alternatif::with('penilaians.kriteria')->get();
        $kriterias = Kriteria::all();

        return view('penilaian.index', compact('alternatifs', 'kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::with('subKriterias')->get();

        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alternatif_id' => 'required|exists:alternatifs,id',
            'nilai.*' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $alternatifId = $request->alternatif_id;
        $nilai = $request->nilai;

        foreach ($nilai as $kriteriaId => $value) {
            Penilaian::updateOrCreate(
                ['alternatif_id' => $alternatifId, 'kriteria_id' => $kriteriaId],
                ['nilai' => $value]
            );
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($alternatifId)
    {
        $alternatif = Alternatif::findOrFail($alternatifId);
        $kriterias = Kriteria::with('subKriterias')->get();
        $penilaians = Penilaian::where('alternatif_id', $alternatifId)->get()->keyBy('kriteria_id');

        return view('penilaian.edit', compact('alternatif', 'kriterias', 'penilaians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $alternatifId)
    {
        $validator = Validator::make($request->all(), [
            'nilai.*' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nilai = $request->nilai;

        foreach ($nilai as $kriteriaId => $value) {
            Penilaian::updateOrCreate(
                ['alternatif_id' => $alternatifId, 'kriteria_id' => $kriteriaId],
                ['nilai' => $value]
            );
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($alternatifId)
    {
        Penilaian::where('alternatif_id', $alternatifId)->delete();

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dihapus');
    }
}
