@extends('layouts.app')

@section('title', 'Detail Perhitungan MOORA')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Perhitungan: {{ $hasil->nama_perhitungan }}</h1>
        <div>
            <a href="{{ route('perhitungan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Perhitungan dilakukan pada: {{ $hasil->created_at->format('d M Y H:i') }}
    </div>

    <!-- Hasil Perangkingan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Perangkingan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Kode</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai Optimasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil->hasil_perangkingan as $index => $alternatif)
                            <tr class="{{ $index === 0 ? 'table-success' : '' }}">
                                <td>{{ $alternatif['rank'] }}</td>
                                <td>{{ $alternatif['kode'] }}</td>
                                <td>{{ $alternatif['nama'] }}</td>
                                <td>{{ number_format($alternatif['nilai_optimasi'], 5) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriks Keputusan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">1. Matriks Keputusan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach (array_keys(reset($hasil->data_perhitungan['matriks_keputusan'])) as $kriteriaId)
                                @php
                                    $kriteria = \App\Models\Kriteria::find($kriteriaId);
                                @endphp
                                <th>{{ $kriteria->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil->data_perhitungan['matriks_keputusan'] as $alternatifId => $nilai)
                            @php
                                $alternatif = \App\Models\Alternatif::find($alternatifId);
                            @endphp
                            <tr>
                                <td>{{ $alternatif->kode }}</td>
                                @foreach ($nilai as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriks Normalisasi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">2. Matriks Normalisasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach (array_keys(reset($hasil->data_perhitungan['matriks_normalisasi'])) as $kriteriaId)
                                @php
                                    $kriteria = \App\Models\Kriteria::find($kriteriaId);
                                @endphp
                                <th>{{ $kriteria->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil->data_perhitungan['matriks_normalisasi'] as $alternatifId => $nilai)
                            @php
                                $alternatif = \App\Models\Alternatif::find($alternatifId);
                            @endphp
                            <tr>
                                <td>{{ $alternatif->kode }}</td>
                                @foreach ($nilai as $value)
                                    <td>{{ number_format($value, 5) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Nilai Optimasi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">3. Nilai Optimasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Nilai Optimasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil->data_perhitungan['nilai_optimasi'] as $alternatifId => $nilai)
                            @php
                                $alternatif = \App\Models\Alternatif::find($alternatifId);
                            @endphp
                            <tr>
                                <td>{{ $alternatif->kode }} - {{ $alternatif->nama }}</td>
                                <td>{{ number_format($nilai, 5) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
