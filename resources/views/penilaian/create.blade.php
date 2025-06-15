@extends('layouts.app')

@section('title', 'Tambah Penilaian')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Penilaian</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Penilaian Alternatif</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('penilaian.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="alternatif_id" class="form-label">Alternatif</label>
                    <select class="form-select @error('alternatif_id') is-invalid @enderror" id="alternatif_id"
                        name="alternatif_id" required>
                        <option value="">-- Pilih Alternatif --</option>
                        @foreach ($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id }}"
                                {{ old('alternatif_id') == $alternatif->id ? 'selected' : '' }}>
                                {{ $alternatif->kode }} - {{ $alternatif->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('alternatif_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <h5 class="mb-3">Penilaian Kriteria</h5>

                @foreach ($kriterias as $kriteria)
                    <div class="mb-3">
                        <label for="nilai_{{ $kriteria->id }}" class="form-label">{{ $kriteria->kode }} -
                            {{ $kriteria->nama }}</label>

                        @if ($kriteria->subKriterias->count() > 0)
                            {{-- Kriteria dengan subkriteria pakai dropdown --}}
                            <select class="form-select @error('nilai.' . $kriteria->id) is-invalid @enderror"
                                id="nilai_{{ $kriteria->id }}" name="nilai[{{ $kriteria->id }}]" required>
                                <option value="">-- Pilih {{ $kriteria->nama }} --</option>
                                @foreach ($kriteria->subKriterias as $subKriteria)
                                    <option value="{{ $subKriteria->nilai }}"
                                        {{ old('nilai.' . $kriteria->id) == $subKriteria->nilai ? 'selected' : '' }}>
                                        {{ $subKriteria->keterangan }} ({{ $subKriteria->nilai }})
                                    </option>
                                @endforeach
                            </select>
                        @else
                            {{-- Kriteria tanpa subkriteria pakai input number --}}
                            <input type="number" class="form-control @error('nilai.' . $kriteria->id) is-invalid @enderror"
                                id="nilai_{{ $kriteria->id }}" name="nilai[{{ $kriteria->id }}]"
                                value="{{ old('nilai.' . $kriteria->id) }}" step="0.01" required>
                        @endif

                        @error('nilai.' . $kriteria->id)
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endforeach


                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
