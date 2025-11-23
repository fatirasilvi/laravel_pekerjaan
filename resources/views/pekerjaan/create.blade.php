{{-- Title --}}
<title>Tambah Pekerjaan Baru</title>

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-briefcase-fill me-2"></i>
                    <h4 class="mb-0">Tambah Pekerjaan</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted mb-4">
                        Silakan isi form di bawah ini untuk menambahkan lowongan pekerjaan baru.
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

                    <form action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            {{-- Baris 1 --}}
                            <div class="col-md-6">
                                <label for="nama_pekerjaan" class="form-label fw-semibold">Nama Pekerjaan</label>
                                <input type="text" name="nama_pekerjaan" class="form-control"
                                    value="{{ old('nama_pekerjaan') }}" placeholder="Contoh: Web Developer" required>
                            </div>

                            <div class="col-md-6">
                                <label for="perusahaan_id" class="form-label fw-semibold">Perusahaan</label>
                                <select name="perusahaan_id" class="form-select" required>
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($perusahaans as $cat)
                                        <option value="{{ $cat->id }}" {{ old('perusahaan_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Baris 2 --}}
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control"
                                    value="{{ old('lokasi') }}" placeholder="Contoh: Surakarta, Jawa Tengah" required>
                            </div>

                            <div class="col-md-6">
                                <label for="gaji" class="form-label fw-semibold">Gaji (Rp)</label>
                                <input type="text" name="gaji" id="gaji" class="form-control"
                                    value="{{ old('gaji') }}" placeholder="Contoh: 6.000.000">
                                <div class="form-text">Ketik angka saja, otomatis diformat ke rupiah.</div>
                            </div>

                            {{-- Baris 3 --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">Status Lowongan</label>
                                <select name="status" class="form-select">
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="profil_perusahaan" class="form-label fw-semibold">Profil Perusahaan</label>
                                <input type="file" name="profil_perusahaan" class="form-control" accept=".jpg,.jpeg,.png">
                                <div class="form-text">Hanya file gambar (JPG, JPEG, PNG) maksimal 2MB.</div>
                            </div>

                            {{-- Baris 4 --}}
                            <div class="col-md-6">
                                <label for="tanggal_posting" class="form-label fw-semibold">Tanggal Posting</label>
                                <input type="date" name="tanggal_posting" class="form-control"
                                    value="{{ old('tanggal_posting') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="batas_lamaran" class="form-label fw-semibold">Batas Lamaran</label>
                                <input type="date" name="batas_lamaran" class="form-control"
                                    value="{{ old('batas_lamaran') }}">
                            </div>

                            {{-- Baris 5 --}}
                            <div class="col-12">
                                <label for="deskripsi_pekerjaan" class="form-label fw-semibold">Deskripsi Pekerjaan</label>
                                <textarea name="deskripsi_pekerjaan" class="form-control" rows="4" required
                                    placeholder="Tuliskan deskripsi pekerjaan secara singkat...">{{ old('deskripsi_pekerjaan') }}</textarea>
                            </div>

                            {{-- Baris 6 --}}
                            <div class="col-12">
                                <label for="kualifikasi" class="form-label fw-semibold">Kualifikasi</label>
                                <textarea name="kualifikasi" class="form-control" rows="3"
                                    placeholder="Contoh: Minimal S1 Informatika, Menguasai Laravel, dsb">{{ old('kualifikasi') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('pekerjaan.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Simpan Pekerjaan
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
    // Fungsi untuk menambahkan titik pemisah ribuan (format Rupiah)
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
