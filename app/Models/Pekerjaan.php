<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_pekerjaan',
        'perusahaan_id',
        'lokasi',
        'deskripsi_pekerjaan',
        'kualifikasi',
        'gaji',
        'tanggal_posting',
        'batas_lamaran',
        'status',
        'profil_perusahaan',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');    }
    
}