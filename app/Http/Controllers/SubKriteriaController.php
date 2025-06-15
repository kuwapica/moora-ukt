<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKriteriaController extends Controller
{
    /**
     * Menampilkan daftar semua sub kriteria.
     */
    public function index()
    {
        $subKriterias = SubKriteria::with('kriteria')->get();
        return view('subkriteria.index', compact('subKriterias'));
    }

    /**
     * Menampilkan form untuk menambahkan sub kriteria baru.
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('subkriteria.create', compact('kriterias'));
    }

    /**
     * Menyimpan sub kriteria baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kriteria_id' => 'required|exists:kriterias,id',
            'keterangan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit sub kriteria.
     */
    public function edit(SubKriteria $subKriteria)
    {
        $kriterias = Kriteria::all();
        return view('subkriteria.edit', compact('subKriteria', 'kriterias'));
    }

    /**
     * Memperbarui data sub kriteria yang sudah ada.
     */
    public function update(Request $request, SubKriteria $subKriteria)
    {
        $validator = Validator::make($request->all(), [
            'kriteria_id' => 'required|exists:kriterias,id',
            'keterangan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subKriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil diperbarui.');
    }

    /**
     * Menghapus sub kriteria dari database.
     */
    public function destroy(SubKriteria $subKriteria)
    {
        $subKriteria->delete();

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil dihapus.');
    }
}
