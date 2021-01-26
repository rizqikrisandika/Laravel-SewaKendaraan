<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kendaraan;
use App\User;
use App\Pemesanan;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kendaraan = Kendaraan::count();
        $user = User::role('user')->count();
        $admin = User::role('admin')->count();
        $pemesanan = Pemesanan::all()->count();

        return view('admin.dashboard',compact('kendaraan', 'user','admin','pemesanan'));
    }
}
