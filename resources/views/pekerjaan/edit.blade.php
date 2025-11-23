{{-- Title --}}
<title>Edit Data Pekerjaan</title>

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="bi bi-pencil-square me-2"></i>
                    <h4 class="mb-0">Edit Pekerjaan</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted mb-4">
                        Silakan ubah data lowongan pekerjaan di bawah ini.
                    </p>

                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong><i class="bi bi-exclamation-triangle-fill me-1"></i>Terjadi kesalahan!</strong>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Edit --}}
                    <form action="{{ route('pekerjaan.update', $pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            {{-- Baris 1 --}}
                            <div class="col-md-6">
                                <label for="nama_pekerjaan" class="form-label fw-semibold">Nama Pekerjaan</label>
                                <input type="text" name="nama_pekerjaan" class="form-control"
                                    value="{{ old('nama_pekerjaan', $pekerjaan->nama_pekerjaan) }}"
                                    placeholder="Contoh: Web Developer" required>
                            </div>

                            <div class="col-md-6">
                                <label for="perusahaan_id" class="form-label fw-semibold">Perusahaan</label>
                                <select name="perusahaan_id" class="form-select" required>
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($perusahaans as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('perusahaan_id', $pekerjaan->perusahaan_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Baris 2 --}}
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control"
                                    value="{{ old('lokasi', $pekerjaan->lokasi) }}"
                                    placeholder="Contoh: Surakarta, Jawa Tengah" required>
                            </div>

                            <div class="col-md-6">
                                <label for="gaji" class="form-label fw-semibold">Gaji (Rp)</label>
                                <input type="text" name="gaji" id="gaji" class="form-control"
                                    value="{{ old('gaji', number_format($pekerjaan->gaji, 0, ',', '.')) }}"
                                    placeholder="Contoh: 6.000.000">
                                <div class="form-text">Ketik angka saja, otomatis diformat ke rupiah.</div>
                            </div>

                            {{-- Baris 3 --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">Status Lowongan</label>
                                <select name="status" class="form-select">
                                    <option value="aktif" {{ old('status', $pekerjaan->status) == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="nonaktif"
                                        {{ old('status', $pekerjaan->status) == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="profil_perusahaan" class="form-label fw-semibold">Profil Perusahaan</label>
                                <input type="file" name="profil_perusahaan" class="form-control" accept=".jpg,.jpeg,.png">
                                <div class="form-text">Format: JPG, PNG, JPEG (maksimal 2MB)</div>

                                {{-- Preview gambar lama --}}
                                @if ($pekerjaan->profil_perusahaan)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $pekerjaan->profil_perusahaan) }}" alt="Profil"
                                            width="100" height="100" class="rounded border">
                                    </div>
                                @endif
                            </div>

                            {{-- Baris 4 --}}
                            <div class="col-md-6">
                                <label for="tanggal_posting" class="form-label fw-semibold">Tanggal Posting</label>
                                <input type="date" name="tanggal_posting" class="form-control"
                                    value="{{ old('tanggal_posting', $pekerjaan->tanggal_posting) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="batas_lamaran" class="form-label fw-semibold">Batas Lamaran</label>
                                <input type="date" name="batas_lamaran" class="form-control"
                                    value="{{ old('batas_lamaran', $pekerjaan->batas_lamaran) }}">
                            </div>

                            {{-- Baris 5 --}}
                            <div class="col-12">
                                <label for="deskripsi_pekerjaan" class="form-label fw-semibold">Deskripsi Pekerjaan</label>
                                <textarea name="deskripsi_pekerjaan" class="form-control" rows="4" required>{{ old('deskripsi_pekerjaan', $pekerjaan->deskripsi_pekerjaan) }}</textarea>
                            </div>

                            {{-- Baris 6 --}}
                            <div class="col-12">
                                <label for="kualifikasi" class="form-label fw-semibold">Kualifikasi</label>
                                <textarea name="kualifikasi" class="form-control" rows="3">{{ old('kualifikasi', $pekerjaan->kualifikasi) }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('pekerjaan.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning px-4 text-black">
                                <i class="bi bi-save"></i> Update Pekerjaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fungsi format Rupiah
    function formatRupiah(angka) {
        let number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return rupiah;
    }

    const gajiInput = document.getElementById('gaji');

    // Event saat mengetik
    gajiInput.addEventListener('input', function(e) {
        this.value = formatRupiah(this.value);
    });

    // Saat submit form, ubah kembali jadi angka (tanpa titik)
    document.querySelector('form').addEventListener('submit', function() {
        gajiInput.value = gajiInput.value.replace(/\./g, '');
    });
</script>
