@extends('layouts.app')

@section('title', 'Manajemen Penilaian')

@section('styles')
    <style>
        /* Enhanced score styling */
        .score-value {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            min-width: 50px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .score-value:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        /* Score color coding */
        .score-value.score-excellent {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .score-value.score-good {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
        }

        .score-value.score-average {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            color: white;
        }

        .score-value.score-poor {
            color: #d97706;
        }

        .score-value.score-empty {
            background: linear-gradient(135deg, #6b7280, #9ca3af);
            color: white;
        }

        /* Action buttons styling */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            justify-content: center;
        }

        .action-buttons .btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
        }

        /* Criteria header styling - HORIZONTAL VERSION */
        .criteria-header {
            /* Header sekarang horizontal, bukan vertikal */
            min-width: 120px;
            max-width: 150px;
            padding: 1rem 0.75rem !important;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.8rem;
            line-height: 1.3;
        }

        /* Tooltip untuk nama kriteria yang terpotong */
        .criteria-header[title]:hover {
            position: relative;
            cursor: help;
            overflow: visible;
            z-index: 10;
        }

        /* Style untuk div dalam criteria header */
        .criteria-header .d-flex {
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }

        .criteria-header strong {
            font-size: 0.9rem;
            color: var(--primary);
        }

        .criteria-header small {
            font-size: 0.7rem;
            opacity: 0.8;
            font-weight: 500;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .criteria-header {
                min-width: 100px;
                max-width: 120px;
                font-size: 0.75rem;
                padding: 0.75rem 0.5rem !important;
            }

            .criteria-header strong {
                font-size: 0.8rem;
            }

            .criteria-header small {
                font-size: 0.65rem;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .content-card-body {
                padding: 1.5rem;
            }



            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 0.5rem 0.25rem;
                font-size: 0.8rem;
            }

            .criteria-header {
                min-width: 80px;
                max-width: 100px;
                font-size: 0.7rem;
                padding: 0.5rem 0.25rem !important;
            }

            .criteria-header strong {
                font-size: 0.75rem;
            }

            .criteria-header small {
                font-size: 0.6rem;
            }
        }

        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h5 {
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        /* Loading states */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            z-index: 10;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Tambahan untuk table scroll horizontal yang lebih smooth */
        .table-responsive {
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
            opacity: 0.7;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title"> <i class="fas fa-clipboard-check me-3"></i> Manajemen Penilaian</h1>
                <p class="page-subtitle mb-0">Kelola penilaian alternatif berdasarkan kriteria yang telah ditentukan</p>
            </div>
            <a href="{{ route('penilaian.create') }}" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>Tambah Penilaian
            </a>
        </div>
    </div>

    <!-- Enhanced Content Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-table"></i>
                Tabel Penilaian Alternatif
            </h3>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Kode</th>
                            <th class="text-left">Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th class="criteria-header" title="{{ $kriteria->nama }}">
                                    <div class="d-flex flex-column align-items-center">
                                        <strong>{{ $kriteria->kode }}</strong>
                                        <small class="opacity-75">{{ $kriteria->nama }}</small>
                                    </div>
                                </th>
                            @endforeach
                            <th><i class="fas fa-cogs"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alternatifs as $alternatif)
                            <tr>
                                <td class="text-left">
                                    <span class="fw-bold text-primary">{{ $loop->iteration }}</span>
                                </td>
                                <td class="text-left">
                                    {{ $alternatif->kode }}
                                </td>
                                <td class="text-left">
                                    {{ $alternatif->nama }}
                                </td>
                                @foreach ($kriterias as $kriteria)
                                    <td>
                                        @php
                                            $penilaian = $alternatif->penilaians
                                                ->where('kriteria_id', $kriteria->id)
                                                ->first();
                                            $nilai = $penilaian ? $penilaian->nilai : null;

                                            // Score classification for styling
                                            $scoreClass = 'score-empty';
                                            if ($nilai !== null) {
                                                if ($nilai >= 80) {
                                                    $scoreClass = 'score-excellent';
                                                } elseif ($nilai >= 70) {
                                                    $scoreClass = 'score-good';
                                                } elseif ($nilai >= 60) {
                                                    $scoreClass = 'score-average';
                                                } elseif ($nilai > 0) {
                                                    $scoreClass = 'score-poor';
                                                }
                                            }
                                        @endphp
                                        <span class="score-value {{ $scoreClass }}">
                                            {{ $nilai ?? '-' }}
                                        </span>
                                    </td>
                                @endforeach
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('penilaian.edit', $alternatif->id) }}"
                                            class="btn btn-enhanced btn-warning btn-sm" title="Edit Penilaian">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('penilaian.destroy', $alternatif->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-enhanced btn-danger btn-sm"
                                                title="Hapus Semua Penilaian"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus semua penilaian untuk alternatif ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($kriterias) + 4 }}" class="text-center">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h5>Belum Ada Data Penilaian</h5>
                                        <p class="mb-3">Silakan tambahkan penilaian untuk alternatif yang tersedia</p>
                                        <a href="{{ route('penilaian.create') }}" class="btn btn-enhanced btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Penilaian Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 10,
                "responsive": true,
                "scrollX": true,
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "columnDefs": [{
                        "targets": [0, 1, 2, -1], // No, Kode, Nama, Aksi
                        "className": "text-left"
                    },
                    {
                        "targets": "_all",
                        "className": "text-center"
                    }
                ]
            });
        });
    </script>
@endsection
