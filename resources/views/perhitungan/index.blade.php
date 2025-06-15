@extends('layouts.app')

@section('title', 'Perhitungan MOORA')

@section('styles')
    <style>
        /* Stats Cards - Simplified */
        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            border-left: 4px solid var(--orange);
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15) !important;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: black;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--text-light);
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Enhanced Card Styling */
        .card-enhanced {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-enhanced:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(161, 98, 7, 0.15) !important;
        }

        .card-header-enhanced {
            background: #fef7ed;
            border-bottom: 2px solid var(--primary);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title-enhanced {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        /* Section Title */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
            color: #495057;
            display: flex;
            align-items: center;
        }

        /* Enhanced Table */
        .table-enhanced {
            margin: 0;
            font-size: 0.9rem;
            background: white;
            width: 100%;
        }

        .table-enhanced thead {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
        }

        .table-enhanced thead th {
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            position: relative;
            vertical-align: middle;
            text-align: center;
        }

        .table-enhanced tbody td {
            padding: 1rem 1.25rem;
            border: none;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
            transition: all 0.2s ease;
            text-align: center;
        }

        .table-enhanced tbody tr {
            transition: all 0.2s ease;
        }

        .table-enhanced tbody tr:hover {
            background: #fafbfc;
        }

        .table-enhanced tbody tr:last-child td {
            border-bottom: none;
        }

        /* Row Number Badge */
        .row-number {
            background: linear-gradient(135deg, var(--orange) 0%, #e86a2c 100%);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(255, 126, 62, 0.3) !important;
        }

        /* Calculation Name */
        .calc-name {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
            text-align: left;
            font-size: 1rem;
        }

        .user-tag {
            background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
            color: #666;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 3px;
            border: 1px solid #dee2e6;
        }

        /* Date Badge */
        .date-badge {
            background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
            color: #2d5a2d;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            border: 1px solid #c3e6cb;
        }

        /* Enhanced Action Buttons */
        .action-group {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            text-decoration: none;
            display: inline-block;
            min-width: 85px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-view {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3) !important;
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4) !important;
        }

        .btn-remove {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3) !important;
        }

        .btn-remove:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4) !important;
        }

        /* Button Loading State */
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: loading-shine 1.5s infinite;
        }

        @keyframes loading-shine {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Enhanced Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 30px;
            color: #999;
        }

        .empty-state .icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #ddd;
        }

        .empty-state h5 {
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            margin-bottom: 20px;
        }

        /* Enhanced Modal */
        .modal-form .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .modal-form .modal-header {
            background: black;
            color: white;
            border: none;
            border-radius: 15px 15px 0 0;
            padding: 20px 25px;
        }

        .modal-form .modal-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin: 0;
        }

        .modal-form .modal-body {
            padding: 25px;
        }

        .modal-form .modal-footer {
            border: none;
            padding: 15px 25px;
            background: #f8f9fa;
            border-radius: 0 0 15px 15px;
        }

        /* Enhanced Form Elements */
        .input-field {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(161, 98, 7, 0.15) !important;
        }

        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 6px 20px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background: #5a6268;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3) !important;
        }

        .info-notice {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            color: #495057;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-left: 4px solid #17a2b8;
        }

        /* Form Loading State */
        .form-loading {
            opacity: 0.7;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
                text-align: center;
            }

            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                text-align: center;
            }

            .btn-professional {
                width: 100%;
                margin-top: 1rem;
                justify-content: center;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .table-enhanced thead th,
            .table-enhanced tbody td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }

            .action-group {
                flex-direction: column;
                gap: 5px;
            }

            .action-btn {
                width: 100%;
                min-width: auto;
            }

            .calc-name {
                text-align: center;
            }

            .stats-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .card-header-enhanced {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
        }

        /* Remove all unnecessary borders */
        .card-enhanced,
        .card-body,
        .table-responsive {
            border-bottom: none !important;
            box-shadow: none !important;
            margin-bottom: 0 !important;
        }

        /* Prevent any flash effects */
        html,
        body {
            transition: none !important;
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Page Header - CONSISTENT STYLE -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-calculator me-3"></i>
                        Perhitungan MOORA
                    </h1>
                    <p class="page-subtitle">Sistem Pendukung Keputusan - Multi-Objective Optimization by Ratio Analysis</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#perhitunganModal">
                        <i class="fas fa-plus me-2"></i>Hitung Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    @if (count($hasilPerhitungans) > 0)
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="stats-number">{{ count($hasilPerhitungans) }}</div>
                    <div class="stats-label">Total Perhitungan</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="stats-number">
                        {{ $hasilPerhitungans->last()->created_at->setTimezone('Asia/Jakarta')->format('M Y') }}</div>
                    <div class="stats-label">Perhitungan Terbaru</div>
                </div>
            </div>
        </div>
    @endif

    <!-- Section Header -->
    <div class="section-header">
        <h5 class="section-title">
            <i class="fas fa-history me-2"></i>Riwayat Perhitungan
        </h5>
        <button type="button" class="btn btn-primary-custom d-md-none" data-bs-toggle="modal"
            data-bs-target="#perhitunganModal">
            <i class="fas fa-plus me-2"></i>Hitung Baru
        </button>
    </div>

    <!-- Enhanced Card -->
    <div class="card-enhanced">
        <div class="card-header-enhanced">
            <h6 class="card-title-enhanced">
                <i class="fas fa-list me-2"></i>Daftar Perhitungan MOORA
            </h6>
            <div style="font-size: 0.9rem; color: var(--text-light);">
                Total: <strong>{{ count($hasilPerhitungans) }}</strong> perhitungan
            </div>
        </div>
        <div class="card-body p-0">
            @if (count($hasilPerhitungans) > 0)
                <div class="table-responsive">
                    <table class="table table-enhanced">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Perhitungan</th>
                                <th style="width: 180px;">Tanggal</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Urutkan data dari yang lama ke yang baru (ascending) dengan indeks baru
                                $sortedHasilPerhitungans = $hasilPerhitungans->sortBy('created_at')->values();
                            @endphp
                            @foreach ($sortedHasilPerhitungans as $index => $hasil)
                                <tr>
                                    <td>
                                        <span class="row-number">{{ $index + 1 }}</span>
                                    </td>
                                    <td style="text-align: left;">
                                        <div class="calc-name">{{ $hasil->nama_perhitungan }}</div>
                                        <span class="user-tag">
                                            <i class="fas fa-user me-1"></i>{{ $hasil->user->name ?? 'System' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="date-badge">
                                            {{ $hasil->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-group">
                                            <a href="{{ route('perhitungan.show', $hasil->id) }}"
                                                class="action-btn btn-view" title="Lihat Detail">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                            <form action="{{ route('perhitungan.destroy', $hasil->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirmDelete(event, '{{ $hasil->nama_perhitungan }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn btn-remove" title="Hapus">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-calculator icon"></i>
                    <h5>Belum Ada Perhitungan</h5>
                    <p>Anda belum melakukan perhitungan MOORA. Klik tombol "Hitung Baru" untuk memulai.</p>
                    <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal"
                        data-bs-target="#perhitunganModal">
                        <i class="fas fa-plus me-2"></i>Mulai Perhitungan
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Perhitungan Baru -->
    <div class="modal fade modal-form" id="perhitunganModal" tabindex="-1" aria-labelledby="perhitunganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perhitunganModalLabel">
                        <i class="fas fa-calculator me-2"></i>Perhitungan MOORA Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('perhitungan.calculate') }}" method="POST" id="formPerhitungan">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_perhitungan" class="form-label fw-bold">
                                <i class="fas fa-tag me-2"></i>Nama Perhitungan
                            </label>
                            <input type="text" class="input-field" id="nama_perhitungan" name="nama_perhitungan"
                                placeholder="Contoh: UKT" required>
                            <div class="form-text mt-2">
                                Berikan nama yang mendeskripsikan perhitungan ini untuk memudahkan identifikasi
                            </div>
                        </div>

                        <div class="info-notice">
                            <i class="fas fa-info-circle text-info"></i>
                            <div>
                                <strong>Informasi:</strong>
                                <p class="mb-0 mt-1">Sistem akan menggunakan data kriteria dan alternatif yang sudah
                                    tersimpan untuk melakukan perhitungan MOORA.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-dark" id="btnHitung">
                            <i class="fas fa-calculator me-2"></i>Mulai Hitung
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Form submission dengan loading state yang smooth (tanpa overlay)
            $('#formPerhitungan').on('submit', function(e) {
                const btn = $('#btnHitung');
                const form = $(this);
                const originalText = btn.html();

                // Loading state pada button saja
                btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menghitung...');
                btn.prop('disabled', true);
                btn.addClass('btn-loading');

                // Tambah class loading pada form
                form.addClass('form-loading');

                // Reset setelah 8 detik (fallback)
                setTimeout(function() {
                    btn.html(originalText);
                    btn.prop('disabled', false);
                    btn.removeClass('btn-loading');
                    form.removeClass('form-loading');
                }, 8000);
            });

            // Auto focus on modal open
            $('#perhitunganModal').on('shown.bs.modal', function() {
                $('#nama_perhitungan').focus();
            });

            // Prevent form double submission
            let isSubmitting = false;
            $('#formPerhitungan').on('submit', function(e) {
                if (isSubmitting) {
                    e.preventDefault();
                    return false;
                }
                isSubmitting = true;
            });
        });

        function confirmDelete(event, name) {
            event.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `
            <p>Apakah Anda yakin ingin menghapus perhitungan:</p>
            <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444;">
                <strong style="color: #dc2626;">${name}</strong>
            </div>
            <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
        `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add loading state to the delete button
                    const deleteBtn = event.target.querySelector('button[type="submit"]');
                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Hapus';
                        deleteBtn.disabled = true;
                    }
                    event.target.submit();
                }
            });

            return false;
        }


        // Enhanced Success notification dengan pop-up yang menarik
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Perhitungan Berhasil!',
                html: `
            <div style="text-align: center; padding: 1rem;">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h5 style="margin: 0; color: white;">{{ session('success') }}</h5>
                </div>
                <p style="color: #6b7280; margin: 0;">Data perhitungan telah tersimpan dan siap untuk dilihat</p>
            </div>
        `,
                confirmButtonColor: 'var(--primary)',
                confirmButtonText: '<i class="fas fa-eye me-2"></i>Lihat Hasil',
                showCancelButton: true,
                cancelButtonText: 'Tutup',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                customClass: {
                    popup: 'animated bounceIn',
                    confirmButton: 'btn-success-custom',
                    cancelButton: 'btn-secondary-custom'
                },
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__bounceOut'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke halaman hasil terbaru jika user klik "Lihat Hasil"
                    @if (isset($hasilPerhitungans) && $hasilPerhitungans->count() > 0)
                        window.location.href =
                            "{{ route('perhitungan.show', $hasilPerhitungans->last()->id ?? '#') }}";
                    @endif
                }
            });
        @endif

        @if (session('delete_success'))
            Swal.fire({
                icon: 'success',
                title: 'Data Dihapus!',
                text: '{{ session('delete_success') }}',
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'OK'
            });
        @endif

        // Enhanced Error notification dengan pop-up yang menarik
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: `
        <div style="text-align: center; padding: 1rem;">
            <div
                style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                <h5 style="margin: 0; color: white;">{{ session('error') }}</h5>
            </div>
            <p style="color: #6b7280; margin: 0;">Silakan periksa data dan coba lagi</p>
        </div>
        `,
                confirmButtonColor: 'var(--primary)',
                confirmButtonText: '<i class="fas fa-redo me-2"></i>Coba Lagi',
                customClass: {
                    popup: 'animated shakeX',
                    confirmButton: 'btn-primary-custom'
                },
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                }
            });
        @endif
    </script>
@endsection
