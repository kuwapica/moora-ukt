@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
    <style>
        /* Dashboard specific enhancements */
        .dashboard-header {
            border-radius: 20px;
            color: black;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(161, 98, 7, 0.2);
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
            position: relative;
            z-index: 2;
        }

        /* Enhanced stat cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-card:hover::before {
            transform: scaleY(1);
        }

        .stat-card.primary::before {
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
        }

        .stat-card.success::before {
            background: linear-gradient(to bottom, #059669, #10b981);
        }

        .stat-card.warning::before {
            background: linear-gradient(to bottom, #d97706, #f59e0b);
        }

        .stat-card.danger::before {
            background: linear-gradient(to bottom, #dc2626, #ef4444);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        /* .stat-icon::before {
                                                                                            content: '';
                                                                                            position: absolute;
                                                                                            inset: 0;
                                                                                            background: inherit;
                                                                                            opacity: 0.1;
                                                                                            border-radius: inherit;
                                                                                        } */

        .stat-icon.primary {
            color: var(--primary);
        }

        .stat-icon.success {
            color: #10b981;
        }

        .stat-icon.warning {
            color: #f59e0b;
        }

        .stat-icon.danger {
            color: #ef4444;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.7;
            margin: 0;
        }

        /* Enhanced content cards */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .content-card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
        }

        .content-card-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 2px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .content-card:hover .content-card-header::before {
            transform: scaleX(1);
        }

        .content-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .content-card-body {
            padding: 2rem;
        }

        /* Enhanced table */
        .enhanced-table {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .enhanced-table thead th {
            background: var(--brown-light);
            font-weight: 600;
            color: var(--text-dark);
            padding: 1rem 1.25rem;
            border: none;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .enhanced-table tbody td {
            padding: 1rem 1.25rem;
            border-color: #f1f5f9;
            vertical-align: middle;
        }

        .enhanced-table tbody tr {
            transition: all 0.2s ease;
        }

        .enhanced-table tbody tr:hover {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
            transform: scale(1.01);
        }

        /* About section styling */
        .about-section {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
            border-radius: 20px;
            padding: 2rem;
            border-left: 4px solid var(--primary);
        }

        .about-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .about-text {
            color: var(--text-dark);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .steps-list {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.1);
        }

        .steps-list ol {
            margin: 0;
            padding-left: 1.5rem;
        }

        .steps-list li {
            padding: 0.5rem 0;
            color: var(--text-dark);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .steps-list li:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 1.5rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            .content-card-body {
                padding: 1.5rem;
            }
        }

        /* Loading animation for stat numbers */
        .stat-number {
            animation: countUp 1s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered animation for cards */
        .stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .stat-card {
            animation: slideInUp 0.6s ease-out both;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Dashboard Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">👋 Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="dashboard-subtitle">Kelola sistem SPK terbaik dengan mudah dan efisien</p>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row mb-5">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-number">{{ $totalAlternatifs }}</div>
                <p class="stat-label">Total Alternatif</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="stat-number">{{ $totalKriterias }}</div>
                <p class="stat-label">Total Kriteria</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card danger">
                <div class="stat-icon danger">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="stat-number">{{ $totalPerhitungans }}</div>
                <p class="stat-label">Total Perhitungan</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Content Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="content-card-title">
                            📊 Perhitungan Terbaru
                        </h3>
                        <a href="{{ route('perhitungan.index') }}" class="btn btn-dark">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="content-card-body">
                    <div class="table-responsive">
                        <table class="table enhanced-table">
                            <thead>
                                <tr>
                                    <th>Nama Perhitungan</th>
                                    <th>User</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestPerhitungans as $perhitungan)
                                    <tr>
                                        <td>
                                            <strong>{{ $perhitungan->nama_perhitungan }}</strong>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{ $perhitungan->user->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted small">
                                                {{ $perhitungan->created_at->format('d M Y') }}
                                            </div>
                                            <div class="text-primary small">
                                                {{ $perhitungan->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('perhitungan.show', $perhitungan->id) }}"
                                                class="btn  btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                                <p class="mb-0">Belum ada perhitungan tersedia</p>
                                                <small>Perhitungan akan muncul di sini setelah dibuat</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h3 class="content-card-title">
                        💡 Tentang SPK
                    </h3>
                </div>
                <div class="content-card-body">
                    <div class="about-section">
                        <p class="about-text">
                            <strong>Sistem Pendukung Keputusan (SPK)</strong> pemilihan penerima keringanan ukt terbaik
                            menggunakan metode
                            <span class="text-primary font-weight-bold">MOORA</span>
                            (Multi-Objective Optimization on the basis of Ratio Analysis).
                        </p>

                        <p class="about-text">
                            MOORA adalah metode yang memiliki perhitungan dengan kalkulasi yang minimum dan sangat
                            sederhana.
                            Metode ini memiliki tingkat selektifitas yang baik dalam menentukan suatu alternatif.
                        </p>

                        <div class="steps-list">
                            <h6 class="about-title mb-3">
                                <i class="fas fa-rocket me-2"></i>Langkah Penggunaan Sistem:
                            </h6>
                            <ul>
                                <li><i class="fas fa-list me-2 text-primary"></i>Kelola data kriteria</li>
                                <li><i class="fas fa-list-alt me-2 text-success"></i>Kelola data sub kriteria</li>
                                <li><i class="fas fa-users me-2 text-warning"></i>Kelola data alternatif</li>
                                <li><i class="fas fa-clipboard-check me-2 text-info"></i>Lakukan penilaian alternatif</li>
                                <li><i class="fas fa-calculator me-2 text-danger"></i>Lakukan perhitungan dengan metode
                                    MOORA</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
