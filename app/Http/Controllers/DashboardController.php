<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kendaraan;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::count();
        $user = User::role('user')->count();

        return view('admin.dashboard',compact('kendaraan', 'user'));
    }
}
