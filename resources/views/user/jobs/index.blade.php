@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Daftar Pekerjaan</h2>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Pekerjaan</th>
                        <th>Perusahaan</th>
                        <th>Lokasi</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jobs as $job)
                        <tr>
                            <!-- NAMA PEKERJAAN -->
                            <td>{{ $job->nama_pekerjaan }}</td>

                            <!-- NAMA PERUSAHAAN -->
                            <td>{{ $job->perusahaan->nama_perusahaan ?? 'Tidak ada' }}</td>

                            <!-- LOKASI -->
                            <td>{{ $job->lokasi }}</td>

                            <td class="d-flex gap-2">

    <a href="{{ route('user.jobs.detail', $job->id) }}" 
       class="btn btn-info btn-sm w-100">
        Detail
    </a>

    <form action="{{ route('user.jobs.apply', $job->id) }}" method="POST" class="w-100">
        @csrf
        <button type="submit" class="btn btn-primary btn-sm w-100">
            Apply
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
