@extends('layouts.app')
@section('title', 'Daftar Perusahaan')
@section('content')
<h3>Daftar Perusahaan</h3>

<div class="mb-3">
    <a href="{{ route('perusahaan.create') }}" class="btn btn-success">Tambah Perusahaan</a>
    <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama Perusahaan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perusahaans as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->nama_perusahaan }}</td>
            <td>
                <a href="{{ route('perusahaan.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('perusahaan.destroy', $p->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
