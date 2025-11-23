<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerjaan');
            $table->foreignId('perusahaan_id')->constrained()->onDelete('cascade');
            $table->string('lokasi');
            $table->text('deskripsi_pekerjaan');
            $table->text('kualifikasi')->nullable();
            $table->decimal('gaji', 15, 2)->nullable();
            $table->date('tanggal_posting')->nullable();
            $table->date('batas_lamaran')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('profil_perusahaan')->nullable(); // untuk menyimpan path file gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pekerjaans');
    }
};
