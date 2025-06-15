@extends('layouts.app')

@section('title', 'Edit Alternatif')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Alternatif</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Alternatif</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Alternatif</label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode"
                        name="kode" value="{{ old('kode', $alternatif->kode) }}" required>
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Contoh: A1, A2, dst.</small>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Alternatif</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $alternatif->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('alternatif.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
