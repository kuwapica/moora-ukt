<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('alternatif.index', compact('alternatifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alternatif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:alternatifs',
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Alternatif::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:alternatifs,kode,' . $alternatif->id,
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $alternatif->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil dihapus');
    }

    /**
     * Bulk delete alternatifs
     */
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
                return redirect()->route('alternatif.index')
                    ->with('error', 'Tidak ada data yang valid untuk dihapus');
            }

            // Hapus alternatif berdasarkan ID yang dipilih
            $deletedCount = Alternatif::whereIn('id', $ids)->delete();

            if ($deletedCount > 0) {
                return redirect()->route('alternatif.index')
                    ->with('success', $deletedCount . ' alternatif berhasil dihapus');
            } else {
                return redirect()->route('alternatif.index')
                    ->with('error', 'Tidak ada data yang berhasil dihapus');
            }
        } catch (\Exception $e) {
            return redirect()->route('alternatif.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
