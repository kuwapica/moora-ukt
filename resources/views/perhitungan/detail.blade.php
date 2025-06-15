@extends('layouts.app')

@section('title', 'Detail Perhitungan MOORA')

@section('styles')
    <style>
        .btn-professional {
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            border: none;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-professional:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-print {
            background: var(--primary);
            color: white;
        }

        .btn-print:hover {
            background: var(--primary);
            color: #f8f9fa;
        }

        .info-alert {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border: 1px solid rgba(161, 98, 7, 0.2);
            color: var(--text-dark);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary);
        }

        .calculation-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .section-header {
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
        }

        .section-header.final-result {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .section-header.step-1 {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        .section-header.step-2 {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        }

        .section-header.step-3 {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .step-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-right: 0.75rem;
            letter-spacing: 0.5px;
        }

        .section-title {
            font-size: 1rem;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .table-professional {
            margin: 0;
            font-size: 0.9rem;
        }

        .table-professional thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .table-professional thead th {
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.85rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
        }

        .table-professional tbody td {
            padding: 0.875rem 1.25rem;
            border: none;
            border-bottom: 1px solid #f1f5f9;
            text-align: center;
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        .table-professional tbody tr {
            transition: all 0.2s ease;
        }

        .table-professional tbody tr:hover {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
            transform: scale(1.002);
        }

        .table-professional tbody tr:last-child td {
            border-bottom: none;
        }

        .rank-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .rank-1 {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
        }

        .rank-2 {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            color: white;
        }

        .rank-3 {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
        }

        .rank-other {
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
            color: #374151;
        }

        .code-badge {
            background: linear-gradient(135deg, var(--orange) 0%, #ea580c 100%);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(255, 126, 62, 0.3);
        }

        .value-display {
            font-family: 'SF Mono', 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.8rem;
            border: 1px solid #e2e8f0;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .winner-row {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fbbf24 100%) !important;
            border-left: 4px solid #f59e0b;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
        }

        .winner-row:hover {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fbbf24 100%) !important;
        }

        .conclusion-section {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.1);
            border-left: 4px solid #10b981;
        }

        .conclusion-title {
            color: #065f46;
            margin-bottom: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .conclusion-text {
            color: #047857;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .winner-name {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            margin: 0.75rem 0;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 3px 10px rgba(6, 95, 70, 0.3);
        }

        .star-icon {
            color: #fbbf24;
            margin-left: 0.5rem;
            filter: drop-shadow(0 2px 4px rgba(251, 191, 36, 0.4));
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
                text-align: center;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .btn-professional {
                flex: 1;
                min-width: 120px;
            }

            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                text-align: center;
            }

            .table-professional {
                font-size: 0.8rem;
            }

            .table-professional thead th,
            .table-professional tbody td {
                padding: 0.75rem 0.5rem;
            }

            .calculation-section {
                margin-bottom: 1.5rem;
            }

            .section-header {
                padding: 1rem 1.25rem;
                flex-direction: column;
                text-align: center;
            }

            .step-badge {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .table-responsive {
                font-size: 0.75rem;
            }

            .code-badge,
            .value-display,
            .rank-badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.4rem;
            }
        }

        /* Print styles */
        @media print {
            .page-header {
                background: #333 !important;
                color: black !important;
                box-shadow: none !important;
            }

            .btn-professional,
            .header-actions {
                display: none !important;
            }

            .calculation-section {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .section-header {
                background: #f5f5f5 !important;
                color: black !important;
            }

            .table-professional tbody tr:hover {
                background: transparent !important;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Print functionality with clean styling
        function printPage() {
            window.print();
        }

        $(document).ready(function() {
            // Simple hover effects
            $('.table-professional tbody tr').hover(
                function() {
                    $(this).find('.value-display').addClass('bg-light');
                },
                function() {
                    $(this).find('.value-display').removeClass('bg-light');
                }
            );

            // Smooth scroll to top
            $('html, body').animate({
                scrollTop: 0
            }, 300);
        });
    </script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-header-content">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-chart-line me-3"></i>
                        Detail Perhitungan MOORA
                    </h1>
                    <p class="page-subtitle">{{ $hasil->nama_perhitungan }}</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('perhitungan.index') }}" class="btn btn-dark">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button onclick="window.print()" class="btn-professional btn-print">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Perangkingan Final -->
    <div class="calculation-section">
        <div class="section-header final-result">
            <span class="step-badge">HASIL</span>
            <h3 class="section-title">
                <i class="fas fa-trophy me-2"></i>Hasil Perangkingan Final
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-professional">
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
                        <tr class="{{ $alternatif['rank'] === 1 ? 'winner-row' : '' }}">
                            <td>
                                @if ($alternatif['rank'] === 1)
                                    <span class="rank-badge rank-1">{{ $alternatif['rank'] }}</span>
                                @elseif($alternatif['rank'] === 2)
                                    <span class="rank-badge rank-2">{{ $alternatif['rank'] }}</span>
                                @elseif($alternatif['rank'] === 3)
                                    <span class="rank-badge rank-3">{{ $alternatif['rank'] }}</span>
                                @else
                                    <span class="rank-badge rank-other">{{ $alternatif['rank'] }}</span>
                                @endif
                            </td>
                            <td><span class="code-badge">{{ $alternatif['kode'] }}</span></td>
                            <td>
                                <strong>{{ $alternatif['nama'] }}</strong>
                                @if ($alternatif['rank'] === 1)
                                    <i class="fas fa-star" style="color: #fbbf24; margin-left: 0.5rem;"></i>
                                @endif
                            </td>
                            <td><span class="value-display">{{ number_format($alternatif['nilai_optimasi'], 5) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- <!-- Kesimpulan -->
    <div class="conclusion-section">
        <div class="conclusion-content">
            @if (count($hasil->hasil_perangkingan) > 0)
                @php
                    $terbaik = collect($hasil->hasil_perangkingan)->where('rank', 1)->first();
                @endphp
                @if ($terbaik)
                    <h6 class="conclusion-title">
                        <i class="fas fa-trophy me-2"></i>Kesimpulan
                    </h6>
                    <p class="conclusion-text">Berdasarkan perhitungan menggunakan metode <strong>MOORA</strong>, alternatif
                        terbaik adalah:</p>

                    <div class="winner-name">{{ $terbaik['kode'] }} - {{ $terbaik['nama'] }}</div>
                    <div style="color: #047857; font-weight: 500; font-size: 0.9rem;">
                        Nilai Optimasi: {{ number_format($terbaik['nilai_optimasi'], 5) }}
                    </div>

                    <div
                        style="background: rgba(16, 185, 129, 0.1); padding: 1rem; border-radius: 8px; margin-top: 1rem; border: 1px solid rgba(16, 185, 129, 0.2); font-size: 0.9rem;">
                        <strong style="color: #065f46;">🏆 Mahasiswa Penerima Keringanan UKT: {{ $terbaik['nama'] }}</strong>
                    </div>
                @else
                    <h6 class="conclusion-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Kesimpulan
                    </h6>
                    <p class="conclusion-text">Data perangkingan tidak valid.</p>
                @endif
            @else
                <h6 class="conclusion-title">
                    <i class="fas fa-inbox me-2"></i>Kesimpulan
                </h6>
                <p class="conclusion-text">Tidak ada data hasil perangkingan yang tersedia.</p>
            @endif
        </div>
    </div> --}}

    <!-- Step 1: Matriks Keputusan -->
    <div class="calculation-section">
        <div class="section-header step-1">
            <span class="step-badge">STEP 1</span>
            <h3 class="section-title">
                <i class="fas fa-table me-2"></i>Matriks Keputusan
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-professional">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @php
                            $matriksKeputusan = $hasil->data_perhitungan['matriks_keputusan'] ?? [];
                            $kriteriaIds = !empty($matriksKeputusan) ? array_keys(reset($matriksKeputusan)) : [];
                        @endphp
                        @foreach ($kriteriaIds as $kriteriaId)
                            @php
                                $kriteria = \App\Models\Kriteria::find($kriteriaId);
                            @endphp
                            <th>{{ $kriteria ? $kriteria->kode : 'C' . $kriteriaId }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Urutkan matriks keputusan secara natural
                        $sortedMatriksKeputusan = collect($matriksKeputusan)
                            ->map(function ($nilai, $alternatifId) {
                                $alternatif = \App\Models\Alternatif::find($alternatifId);
                                return [
                                    'alternatif_id' => $alternatifId,
                                    'kode' => $alternatif ? $alternatif->kode : '',
                                    'nilai' => $nilai,
                                ];
                            })
                            ->sortBy(function ($item) {
                                if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                                    return $matches[1] . sprintf('%03d', (int) $matches[2]);
                                }
                                return $item['kode'];
                            });
                    @endphp
                    @foreach ($sortedMatriksKeputusan as $item)
                        <tr>
                            <td><span class="code-badge">{{ $item['kode'] }}</span></td>
                            @foreach ($item['nilai'] as $value)
                                <td><span class="value-display">{{ $value }}</span></td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Step 2: Matriks Normalisasi -->
    <div class="calculation-section">
        <div class="section-header step-2">
            <span class="step-badge">STEP 2</span>
            <h3 class="section-title">
                <i class="fas fa-calculator me-2"></i>Matriks Normalisasi
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-professional">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @php
                            $matriksNormalisasi = $hasil->data_perhitungan['matriks_normalisasi'] ?? [];
                            $kriteriaIds = !empty($matriksNormalisasi) ? array_keys(reset($matriksNormalisasi)) : [];
                        @endphp
                        @foreach ($kriteriaIds as $kriteriaId)
                            @php
                                $kriteria = \App\Models\Kriteria::find($kriteriaId);
                            @endphp
                            <th>{{ $kriteria ? $kriteria->kode : 'C' . $kriteriaId }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Urutkan matriks normalisasi secara natural
                        $sortedMatriksNormalisasi = collect($matriksNormalisasi)
                            ->map(function ($nilai, $alternatifId) {
                                $alternatif = \App\Models\Alternatif::find($alternatifId);
                                return [
                                    'alternatif_id' => $alternatifId,
                                    'kode' => $alternatif ? $alternatif->kode : '',
                                    'nilai' => $nilai,
                                ];
                            })
                            ->sortBy(function ($item) {
                                if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                                    return $matches[1] . sprintf('%03d', (int) $matches[2]);
                                }
                                return $item['kode'];
                            });
                    @endphp
                    @foreach ($sortedMatriksNormalisasi as $item)
                        <tr>
                            <td><span class="code-badge">{{ $item['kode'] }}</span></td>
                            @foreach ($item['nilai'] as $value)
                                <td><span class="value-display">{{ number_format($value, 5) }}</span></td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Step 3: Nilai Optimasi - FIXED VERSION -->
    <div class="calculation-section">
        <div class="section-header step-3">
            <span class="step-badge">STEP 3</span>
            <h3 class="section-title">
                <i class="fas fa-chart-bar me-2"></i>Nilai Optimasi
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-professional">
                <thead>
                    <tr>
                        <th style="width: 15%;">Kode</th>
                        <th style="width: 50%;">Nama Alternatif</th>
                        <th style="width: 35%;">Nilai Optimasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Method 1: Coba ambil dari data_perhitungan nilai_optimasi
                        $nilaiOptimasiData = $hasil->data_perhitungan['nilai_optimasi'] ?? [];

                        // Method 2: Jika tidak ada atau kosong, coba dari hasil_perangkingan
                        if (empty($nilaiOptimasiData) && !empty($hasil->hasil_perangkingan)) {
                            $nilaiOptimasiData = collect($hasil->hasil_perangkingan)
                                ->pluck('nilai_optimasi', 'alternatif_id')
                                ->toArray();
                        }

                        // Method 3: Ambil semua alternatif dan cocokkan dengan data yang ada
                        $allAlternatifs = \App\Models\Alternatif::orderBy('kode')->get();

                        $sortedNilaiOptimasi = $allAlternatifs
                            ->map(function ($alternatif) use ($nilaiOptimasiData, $hasil) {
                                // Cari nilai optimasi untuk alternatif ini
                                $nilaiOptimasi = 0;

                                // Coba dari data_perhitungan
                                if (isset($nilaiOptimasiData[$alternatif->id])) {
                                    $nilaiOptimasi = $nilaiOptimasiData[$alternatif->id];
                                }
                                // Coba dari hasil_perangkingan berdasarkan kode
                                elseif (!empty($hasil->hasil_perangkingan)) {
                                    $hasilItem = collect($hasil->hasil_perangkingan)
                                        ->where('kode', $alternatif->kode)
                                        ->first();
                                    if ($hasilItem) {
                                        $nilaiOptimasi = $hasilItem['nilai_optimasi'] ?? 0;
                                    }
                                }
                                // Coba dari hasil_perangkingan berdasarkan nama
                                elseif (!empty($hasil->hasil_perangkingan)) {
                                    $hasilItem = collect($hasil->hasil_perangkingan)
                                        ->where('nama', $alternatif->nama)
                                        ->first();
                                    if ($hasilItem) {
                                        $nilaiOptimasi = $hasilItem['nilai_optimasi'] ?? 0;
                                    }
                                }

                                return [
                                    'alternatif_id' => $alternatif->id,
                                    'kode' => $alternatif->kode,
                                    'nama' => $alternatif->nama,
                                    'nilai' => $nilaiOptimasi,
                                ];
                            })
                            ->filter(function ($item) {
                                // Filter hanya yang memiliki data valid
                                return !empty($item['kode']) && !empty($item['nama']);
                            })
                            ->sortBy(function ($item) {
                                // Natural sort untuk kode seperti A1, A2, ..., A10
                                if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                                    return $matches[1] . sprintf('%03d', (int) $matches[2]);
                                }
                                return $item['kode'];
                            });

                        // Method 4: Fallback - jika masih kosong, coba langsung dari collection data_perhitungan
                        if ($sortedNilaiOptimasi->isEmpty() && !empty($hasil->data_perhitungan['nilai_optimasi'])) {
                            $sortedNilaiOptimasi = collect($hasil->data_perhitungan['nilai_optimasi'])
                                ->map(function ($nilai, $alternatifId) {
                                    $alternatif = \App\Models\Alternatif::find($alternatifId);
                                    return [
                                        'alternatif_id' => $alternatifId,
                                        'kode' => $alternatif ? $alternatif->kode : 'A' . $alternatifId,
                                        'nama' => $alternatif ? $alternatif->nama : 'Alternatif ' . $alternatifId,
                                        'nilai' => $nilai,
                                    ];
                                })
                                ->filter(function ($item) {
                                    return !empty($item['kode']) && !empty($item['nama']);
                                })
                                ->sortBy(function ($item) {
                                    if (preg_match('/^([A-Za-z]+)(\d+)$/', $item['kode'], $matches)) {
                                        return $matches[1] . sprintf('%03d', (int) $matches[2]);
                                    }
                                    return $item['kode'];
                                });
                        }
                    @endphp

                    @if ($sortedNilaiOptimasi->count() > 0)
                        @foreach ($sortedNilaiOptimasi as $item)
                            <tr>
                                <td>
                                    <span class="code-badge">{{ $item['kode'] }}</span>
                                </td>
                                <td class="text-start">
                                    <strong>{{ $item['nama'] }}</strong>
                                </td>
                                <td>
                                    <span class="value-display">{{ number_format($item['nilai'], 5) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <!-- Fallback terakhir: Tampilkan pesan jika tidak ada data -->
                        <tr>
                            <td colspan="3" class="text-center" style="padding: 2rem;">
                                <div style="color: #6b7280;">
                                    <i class="fas fa-exclamation-circle"
                                        style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                    <h6>Data Nilai Optimasi Tidak Tersedia</h6>
                                    <p class="mb-0">Silakan periksa kembali data perhitungan atau hubungi administrator.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
