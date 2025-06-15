@extends('layouts.app')

@section('title', 'Edit Penilaian')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Penilaian: {{ $alternatif->kode }} - {{ $alternatif->nama }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Penilaian</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h5 class="mb-3">Penilaian Kriteria</h5>

                @foreach ($kriterias as $kriteria)
                    <div class="mb-3">
                        <label for="nilai_{{ $kriteria->id }}" class="form-label">{{ $kriteria->kode }} -
                            {{ $kriteria->nama }}</label>

                        @php
                            $penilaian = $penilaians->where('kriteria_id', $kriteria->id)->first();
                            $nilai = $penilaian ? $penilaian->nilai : '';
                        @endphp

                        @if ($kriteria->subKriterias->count() > 0)
                            <select class="form-select @error('nilai.' . $kriteria->id) is-invalid @enderror"
                                id="nilai_{{ $kriteria->id }}" name="nilai[{{ $kriteria->id }}]" required>
                                <option value="">-- Pilih {{ $kriteria->nama }} --</option>
                                @foreach ($kriteria->subKriterias as $subKriteria)
                                    <option value="{{ $subKriteria->nilai }}"
                                        {{ old('nilai.' . $kriteria->id, $nilai) == $subKriteria->nilai ? 'selected' : '' }}>
                                        {{ $subKriteria->keterangan }} ({{ $subKriteria->nilai }})
                                    </option>
                                @endforeach
                            </select>
                        @else
                            {{-- Kriteria tanpa subkriteria pakai input number --}}
                            <input type="number" class="form-control @error('nilai.' . $kriteria->id) is-invalid @enderror"
                                id="nilai_{{ $kriteria->id }}" name="nilai[{{ $kriteria->id }}]"
                                value="{{ old('nilai.' . $kriteria->id, $nilai) }}" step="0.01" required>
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
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
