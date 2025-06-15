@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Kriteria</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kriteria</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Kriteria</label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode"
                        name="kode" value="{{ old('kode', $kriteria->kode) }}" required>
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Contoh: C1, C2, dst.</small>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kriteria</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $kriteria->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot</label>
                    <input type="number" class="form-control @error('bobot') is-invalid @enderror" id="bobot"
                        name="bobot" value="{{ old('bobot', $kriteria->bobot) }}" step="0.001" min="0"
                        max="1" required>
                    @error('bobot')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Nilai antara 0 dan 1. Total bobot semua kriteria harus 1.</small>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                        <option value="benefit" {{ old('jenis', $kriteria->jenis) == 'benefit' ? 'selected' : '' }}>
                            Benefit (Nilai lebih tinggi lebih baik)</option>
                        <option value="cost" {{ old('jenis', $kriteria->jenis) == 'cost' ? 'selected' : '' }}>Cost
                            (Nilai lebih rendah lebih baik)</option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
