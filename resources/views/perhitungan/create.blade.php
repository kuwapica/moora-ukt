<!DOCTYPE html>
<html>

<head>
    <title>Detail Perhitungan MOORA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
            line-height: 1.4;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .info-box {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border-left: 4px solid #bee5eb;
        }

        .section-header {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px 15px;
            margin: 20px 0 10px 0;
            border-radius: 5px;
            font-weight: bold;
            border-left: 4px solid #ffeaa7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
        }

        .highlight {
            background-color: #d4edda !important;
            color: #155724;
            font-weight: bold;
        }

        .conclusion-box {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #ffeaa7;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8em;
            color: #666;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .section-container {
            page-break-inside: avoid;
            break-inside: avoid;
            margin-bottom: 30px;
        }

        /* Khusus untuk halaman 2 - gabungan tabel */
        .combined-tables-container {
            page-break-inside: avoid;
        }

        .table-spacing {
            margin-bottom: 40px;
        }

        @media print {
            .no-print {
                display: none;
            }

            .page-break {
                page-break-before: always !important;
            }

            body {
                padding: 10px;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>

<body>
    <!-- HALAMAN 1: Matriks Keputusan -->
    <div class="header">
        <h2>SPK Karyawan Terbaik</h2>
        <h3>Detail Perhitungan: {{ $perhitungan->nama_perhitungan }}</h3>
    </div>

    <div class="info-box">
        <p><strong>Perhitungan dilakukan pada:</strong> {{ $perhitungan->created_at->format('d M Y H:i') }}</p>
    </div>

    <!-- Matriks Keputusan -->
    <div class="section-container">
        <div class="section-header">1. Matriks Keputusan</div>
        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @php
                        $matriksKeputusan = $perhitungan->data_perhitungan['matriks_keputusan'] ?? [];
                        $kriteriaIds = !empty($matriksKeputusan) ? array_keys(reset($matriksKeputusan)) : [];
                    @endphp
                    @foreach ($kriteriaIds as $kriteriaId)
                        @php
                            $kriteria = \App\Models\Kriteria::find($kriteriaId);
                        @endphp
                        <th>{{ $kriteria ? $kriteria->kode : 'Kriteria #' . $kriteriaId }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($matriksKeputusan as $alternatifId => $nilai)
                    @php
                        $alternatif = \App\Models\Alternatif::find($alternatifId);
                    @endphp
                    <tr>
                        <td>{{ $alternatif ? $alternatif->kode : 'A' . $loop->iteration }}</td>
                        @foreach ($nilai as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- HALAMAN 2: Matriks Normalisasi dan Nilai Optimasi (Digabung) -->
    <div class="page-break"></div>
    <div class="combined-tables-container">
        <!-- Matriks Normalisasi -->
        <div class="section-container table-spacing">
            <div class="section-header">2. Matriks Normalisasi</div>
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @php
                            $matriksNormalisasi = $perhitungan->data_perhitungan['matriks_normalisasi'] ?? [];
                            $kriteriaIds = !empty($matriksNormalisasi) ? array_keys(reset($matriksNormalisasi)) : [];
                        @endphp
                        @foreach ($kriteriaIds as $kriteriaId)
                            @php
                                $kriteria = \App\Models\Kriteria::find($kriteriaId);
                            @endphp
                            <th>{{ $kriteria ? $kriteria->kode : 'Kriteria #' . $kriteriaId }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriksNormalisasi as $alternatifId => $nilai)
                        @php
                            $alternatif = \App\Models\Alternatif::find($alternatifId);
                        @endphp
                        <tr>
                            <td>{{ $alternatif ? $alternatif->kode : 'A' . $loop->iteration }}</td>
                            @foreach ($nilai as $value)
                                <td>{{ number_format($value, 5) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Nilai Optimasi -->
        <div class="section-container">
            <div class="section-header">3. Nilai Optimasi</div>
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>Nilai Optimasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Ambil data dari hasil perangkingan yang sudah terurut
                        $hasilPerhitungan = collect($perhitungan->hasil_perangkingan)->sortBy('kode');
                    @endphp
                    @foreach ($hasilPerhitungan as $alternatif)
                        <tr>
                            <td>{{ $alternatif['kode'] }} - {{ $alternatif['nama'] }}</td>
                            <td>{{ number_format($alternatif['nilai_optimasi'], 5) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- HALAMAN 3: Hasil Perangkingan dan Footer -->
    <div class="page-break"></div>

    <!-- Hasil Perangkingan -->
    <div class="section-container">
        <div class="section-header">4. Hasil Perangkingan</div>
        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <th>Nilai Optimasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perhitungan->hasil_perangkingan as $alternatif)
                    <tr class="{{ $alternatif['rank'] === 1 ? 'highlight' : '' }}">
                        <td>{{ $alternatif['rank'] }}</td>
                        <td>{{ $alternatif['kode'] }}</td>
                        <td>{{ $alternatif['nama'] }}</td>
                        <td>{{ number_format($alternatif['nilai_optimasi'], 5) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dihasilkan otomatis oleh Sistem Pendukung Keputusan MOORA</p>
        <p>{{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <!-- Tombol Cetak (tidak akan muncul saat print) -->
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()"
            style="padding: 10px 20px; margin: 5px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Cetak</button>
        <button onclick="window.close()"
            style="padding: 10px 20px; margin: 5px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer;">Tutup</button>
    </div>
</body>

</html>
