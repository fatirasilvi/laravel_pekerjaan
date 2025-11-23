@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $job->nama_pekerjaan }}</h4>
            <span class="badge {{ $job->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                {{ ucfirst($job->status) }}
            </span>
        </div>

        <div class="card-body">
            {{-- Profil Perusahaan --}}
            <div class="row mb-4">
                <div class="col-md-3 text-center">
                    @if ($job->profil_perusahaan)
                        <img src="{{ asset('storage/' . $job->profil_perusahaan) }}"
                            class="img-fluid rounded" alt="Logo Perusahaan">
                    @else
                        <img src="https://via.placeholder.com/150"
                            class="img-fluid rounded" alt="No Image">
                    @endif
                </div>

                <div class="col-md-9">
                    <h5 class="fw-bold">{{ $job->perusahaan->nama_perusahaan }}</h5>
                    <p class="text-muted">
                        <i class="bi bi-geo-alt"></i> {{ $job->lokasi }}
                    </p>
                </div>
            </div>

            <hr>

            {{-- Detail Pekerjaan --}}
            <h5>Deskripsi Pekerjaan</h5>
            <p>{{ $job->deskripsi_pekerjaan }}</p>

            <h5>Kualifikasi</h5>
            <p>{{ $job->kualifikasi }}</p>

            <div class="row my-3">
                <div class="col-md-6">
                    <p><strong>Gaji:</strong> Rp {{ number_format($job->gaji, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Batas Lamaran:</strong> {{ $job->batas_lamaran }}</p>
                </div>
            </div>

            <hr>

            {{-- Tombol Apply --}}
            <form action="{{ route('user.jobs.apply', $job->id) }}" method="POST">
                @csrf
                <button class="btn btn-success w-100">
                    <i class="bi bi-send"></i> Apply Sekarang
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
