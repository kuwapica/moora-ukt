@extends('layouts.app')

@section('title', 'Edit Sub Kriteria')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Sub Kriteria</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Sub Kriteria</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('subkriteria.update', $subKriteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kriteria_id" class="form-label">Kriteria</label>
                    <select class="form-select @error('kriteria_id') is-invalid @enderror" id="kriteria_id"
                        name="kriteria_id" required>
                        <option value="">-- Pilih Kriteria --</option>
                        @foreach ($kriterias as $kriteria)
                            <option value="{{ $kriteria->id }}"
                                {{ old('kriteria_id', $subKriteria->kriteria_id) == $kriteria->id ? 'selected' : '' }}>
                                {{ $kriteria->kode }} - {{ $kriteria->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kriteria_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                        name="keterangan" value="{{ old('keterangan', $subKriteria->keterangan) }}" required>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Contoh: Sangat Baik, Baik, Cukup, dst.</small>
                </div>

                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" class="form-control @error('nilai') is-invalid @enderror" id="nilai"
                        name="nilai" value="{{ old('nilai', $subKriteria->nilai) }}" required>
                    @error('nilai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Masukkan nilai numerik untuk keterangan ini.</small>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('subkriteria.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
