@extends('layouts.app')
@section('title', 'Tambah Perusahaan')
@section('content')
<h3>Tambah Perusahaan</h3>

<form action="{{ route('perusahaan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection

