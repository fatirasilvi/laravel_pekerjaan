<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PekerjaanController extends Controller
{
    /**
     * Menampilkan daftar semua pekerjaan
     */
    public function index()
    {
        $pekerjaans = Pekerjaan::with('perusahaan')->latest()->get();
        $perusahaans = Perusahaan::all(); // untuk filter di datatables
        return view('pekerjaan.index', compact('pekerjaans', 'perusahaans'));
    }

    /**
     * Menampilkan form tambah pekerjaan
     */
    public function create()
    {
        $perusahaans = Perusahaan::all();
        return view('pekerjaan.create', compact('perusahaans'));
    }

    /**
     * Menyimpan data pekerjaan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'lokasi' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'nullable|string',
            'gaji' => 'nullable|numeric',
            'tanggal_posting' => 'nullable|date',
            'batas_lamaran' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
            'profil_perusahaan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ validasi tambahan
        ]);

        $data = $request->all();

        // Upload file jika ada
        if ($request->hasFile('profil_perusahaan')) {
            $data['profil_perusahaan'] = $request->file('profil_perusahaan')->store('uploads/profil_perusahaan', 'public');
        }

        Pekerjaan::create($data);

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail pekerjaan
     */
    public function show($id)
    {
        $pekerjaan = Pekerjaan::with('perusahaan')->findOrFail($id);
        return view('pekerjaan.detail', compact('pekerjaan'));
    }

    /**
     * Menampilkan form edit pekerjaan
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        $perusahaans = Perusahaan::all();
        return view('pekerjaan.edit', compact('pekerjaan', 'perusahaans'));
    }

    /**
     * Memperbarui data pekerjaan yang ada
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'lokasi' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi' => 'nullable|string',
            'gaji' => 'nullable|numeric',
            'tanggal_posting' => 'nullable|date',
            'batas_lamaran' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
            'profil_perusahaan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Hapus dan update file baru jika ada
        if ($request->hasFile('profil_perusahaan')) {
            if ($pekerjaan->profil_perusahaan && Storage::disk('public')->exists($pekerjaan->profil_perusahaan)) {
                Storage::disk('public')->delete($pekerjaan->profil_perusahaan);
            }
            $data['profil_perusahaan'] = $request->file('profil_perusahaan')->store('uploads/profil_perusahaan', 'public');
        }

        $pekerjaan->update($data);

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil diperbarui!');
    }

    /**
     * Menghapus data pekerjaan
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        // Hapus file jika ada
        if ($pekerjaan->profil_perusahaan && Storage::disk('public')->exists($pekerjaan->profil_perusahaan)) {
            Storage::disk('public')->delete($pekerjaan->profil_perusahaan);
        }

        $pekerjaan->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'Pekerjaan berhasil dihapus!');
    }
    public function listForUser()
{
    $jobs = Pekerjaan::with('perusahaan')->get();
    return view('user.jobs.index', compact('jobs'));
}


    public function apply($id)
    {
        $job = Pekerjaan::findOrFail($id);

        // Simpan lamaran → untuk modul cukup simpan ke log
        // atau buat tabel "applications" untuk yang lebih lengkap

        \Log::info('User '.auth()->user()->name.' melamar pekerjaan '.$job->nama);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    public function showJobUser($id)
{
    $job = Pekerjaan::with('perusahaan')->findOrFail($id);
    return view('user.jobs.detail', compact('job'));
}




}

