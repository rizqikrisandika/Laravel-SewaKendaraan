<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Kendaraan;
use App\User;

class Pemesanan extends Model
{
    protected $fillable = ['user_id','kendaraan_id','dari','sampai','total_harga','alamat','created_by'];
    protected $table = 'pemesanan';

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
