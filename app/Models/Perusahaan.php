<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = ['nama_perusahaan'];

    public function pekerjaans()
    {
        return $this->hasMany(Pekerjaan::class);
    }
}
