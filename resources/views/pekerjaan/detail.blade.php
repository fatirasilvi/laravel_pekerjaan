{{-- Title --}}
<title>Detail Data Pekerjaan</title>

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $pekerjaan->nama_pekerjaan }}</h4>
            <span class="badge {{ $pekerjaan->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                {{ ucfirst($pekerjaan->status) }}
            </span>
        </div>

        <div class="card-body">
            {{-- Profil Perusahaan --}}
            <div class="row mb-4">
                <div class="col-md-3 text-center">
                    @if ($pekerjaan->profil_perusahaan)
                        <img src="{{ asset('storage/' . $pekerjaan->profil_perusahaan) }}"
                            alt="Profil Perusahaan"
                            class="img-fluid rounded border"
                            style="max-height:180px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/180x180?text=No+Image"
                            alt="No Image"
                            class="img-fluid rounded border">
                    @endif
                </div>

                <div class="col-md-9">
                    <h5 class="mb-1">{{ $pekerjaan->perusahaan->nama_perusahaan ?? '-' }}</h5>
                    <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> {{ $pekerjaan->lokasi ?? '-' }}</p>
                    <p class="mb-0"><strong>Gaji:</strong> Rp {{ number_format($pekerjaan->gaji ?? 0, 0, ',', '.') }}</p>

                    <p class="mb-0"><strong>Tanggal Posting:</strong>
                        {{ $pekerjaan->tanggal_posting ? \Carbon\Carbon::parse($pekerjaan->tanggal_posting)->translatedFormat('d F Y') : '-' }}
                    </p>

                    <p class="mb-0"><strong>Batas Lamaran:</strong>
                        {{ $pekerjaan->batas_lamaran ? \Carbon\Carbon::parse($pekerjaan->batas_lamaran)->translatedFormat('d F Y') : '-' }}
                    </p>
                </div>
            </div>

            <hr>

            {{-- Deskripsi Pekerjaan --}}
            <div class="mb-4">
                <h5 class="text-primary">Deskripsi Pekerjaan</h5>
                <p style="white-space: pre-line;">{{ $pekerjaan->deskripsi_pekerjaan }}</p>
            </div>

            {{-- Kualifikasi --}}
            <div class="mb-4">
                <h5 class="text-primary">Kualifikasi</h5>
                <p style="white-space: pre-line;">{{ $pekerjaan->kualifikasi ?? '-' }}</p>
            </div>

            <hr>

            {{-- Informasi Tambahan --}}
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <small class="text-muted d-block">
                        <i class="bi bi-calendar-check"></i> Dibuat pada:
                        {{ $pekerjaan->created_at ? $pekerjaan->created_at->format('d M Y, H:i') : '-' }}
                    </small>
                    <small class="text-muted d-block">
                        <i class="bi bi-arrow-repeat"></i> Diperbarui terakhir:
                        {{ $pekerjaan->updated_at ? $pekerjaan->updated_at->format('d M Y, H:i') : '-' }}
                    </small>
                </div>

                <div>
                    <a href="{{ route('pekerjaan.edit', $pekerjaan->id) }}" class="btn btn-warning btn-sm text-dark">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
