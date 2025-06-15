<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:kriterias',
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:1',
            'jenis' => 'required|in:benefit,cost',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Kriteria::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:kriterias,kode,' . $kriteria->id,
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:1',
            'jenis' => 'required|in:benefit,cost',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'ids' => 'required|string'
            ]);

            $ids = explode(',', $request->ids);

            // Validasi bahwa semua ID adalah angka dan tidak kosong
            $ids = array_filter($ids, function ($id) {
                return is_numeric($id) && !empty(trim($id));
            });

            if (empty($ids)) {
                return redirect()->route('kriteria.index')
                    ->with('error', 'Tidak ada data yang valid untuk dihapus');
            }

            // Hapus kriteria berdasarkan ID yang dipilih
            $deletedCount = Kriteria::whereIn('id', $ids)->delete();

            if ($deletedCount > 0) {
                return redirect()->route('kriteria.index')
                    ->with('success', $deletedCount . ' kriteria berhasil dihapus');
            } else {
                return redirect()->route('kriteria.index')
                    ->with('error', 'Tidak ada data yang berhasil dihapus');
            }
        } catch (\Exception $e) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
