<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Kategori;
use App\User;
use App\Pemesanan;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $fillable = ['nama','slug','plat','harga','gambar','kategori_id','user_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanan()
    {
        return $this->hasOne(Pemesanan::class);
    }
}
