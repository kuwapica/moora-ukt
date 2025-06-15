@extends('layouts.app')

@section('title', 'Manajemen Sub Kriteria')

@section('styles')
    <style>
    </style>

@endsection

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title"> <i class="fas fa-list-alt me-3"></i> Manajemen Sub Kriteria</h1>
            </div>
            <a href="{{ route('subkriteria.create') }}" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i> Tambah Sub Kriteria
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-table me-2"></i>
                Daftar Sub Kriteria
            </h3>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                    <thead width="80" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subKriterias as $subKriteria)
                            <tr>
                                <td class="text-left"><span class="fw-bold text-primary">{{ $loop->iteration }}</span></td>
                                <td>{{ $subKriteria->kriteria->kode }} - {{ $subKriteria->kriteria->nama }}</td>
                                <td>{{ $subKriteria->keterangan }}</td>
                                <td>{{ $subKriteria->nilai }}</td>
                                <td>
                                    <a href="{{ route('subkriteria.edit', $subKriteria->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('subkriteria.destroy', $subKriteria->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            });
        });
    </script>

@endsection
