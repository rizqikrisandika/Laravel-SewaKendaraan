<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Kendaraan;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama','slug'];

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }
}
