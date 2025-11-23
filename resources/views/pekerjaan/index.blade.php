{{-- Title --}}
<title>Daftar Pekerjaan</title>
{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
{{-- DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css">

<div class="container mt-4">
    <h2 class="mb-4">Daftar Pekerjaan</h2>

    {{-- Tombol Aksi --}}
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('pekerjaan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Pekerjaan
        </a>
        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">
            <i class="bi bi-building"></i> Lihat Perusahaan
        </a>
    </div>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter Form --}}
    <div class="card mb-3">
        <div class="card-body">
            <form id="filterForm" class="row g-3">
                <div class="col-md-4">
                    <label for="filterPerusahaan" class="form-label">Filter Perusahaan</label>
                    <select id="filterPerusahaan" class="form-select">
                        <option value="">Semua Perusahaan</option>
                        @foreach ($pekerjaans->pluck('perusahaan')->unique('id') as $perusahaan)
                            <option value="{{ $perusahaan->nama_perusahaan }}">
                                {{ $perusahaan->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filterStatus" class="form-label">Filter Status</label>
                    <select id="filterStatus" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" id="resetFilter" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table id="tabelPekerjaan" class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Perusahaan</th>
                    <th>Lokasi</th>
                    <th>Gaji</th>
                    <th>Status</th>
                    <th>Batas Lamaran</th>
                    <th>Profil</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pekerjaans as $p)
                    @php
                        $today = \Carbon\Carbon::now();
                        $batasLamaran = \Carbon\Carbon::parse($p->batas_lamaran);
                        $statusAktif = $p->status == 'aktif' && $batasLamaran->gte($today);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $p->nama_pekerjaan }}</td>
                        <td>{{ $p->perusahaan->nama_perusahaan ?? '-' }}</td>
                        <td>{{ $p->lokasi ?? '-' }}</td>
                        <td>Rp {{ number_format($p->gaji ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <span class="badge {{ $statusAktif ? 'bg-success' : 'bg-secondary' }}">
                                {{ $statusAktif ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td>
                            {{ $p->batas_lamaran ? \Carbon\Carbon::parse($p->batas_lamaran)->translatedFormat('d F Y') : '-' }}
                        </td>
                        <td class="text-center">
                            @if ($p->profil_perusahaan)
                                <img src="{{ asset('storage/' . $p->profil_perusahaan) }}" alt="Profil"
                                    width="60" height="60" class="rounded border">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pekerjaan.show', $p->id) }}" class="btn btn-info btn-sm"
                                data-bs-toggle="tooltip" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('pekerjaan.edit', $p->id) }}" class="btn btn-warning btn-sm"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('pekerjaan.destroy', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Belum ada data pekerjaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Script Bootstrap --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
{{-- DataTables --}}
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#tabelPekerjaan').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
            },
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            "columnDefs": [
                { "orderable": false, "targets": [7, 8] } // Kolom Profil dan Aksi tidak bisa di-sort
            ]
        });

        // Filter Perusahaan
        $('#filterPerusahaan').on('change', function() {
            table.column(2).search(this.value).draw();
        });

        // Filter Status
        $('#filterStatus').on('change', function() {
            table.column(5).search(this.value).draw();
        });

        // Reset Filter
        $('#resetFilter').on('click', function() {
            $('#filterPerusahaan').val('');
            $('#filterStatus').val('');
            table.search('').columns().search('').draw();
        });

        // Tooltip Bootstrap
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
    });
</script>