<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class PenggunaController extends Controller
{
    public function index()
    {
        $user = User::role('user')->paginate(10);

        return view('admin.pengguna', compact('user'));
    }
}
