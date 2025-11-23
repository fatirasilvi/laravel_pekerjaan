<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // tambahkan ini

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
