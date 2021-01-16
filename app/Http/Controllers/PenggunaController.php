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

    public function store(Request $request)
    {

        $request->validate([
            'nik' => 'required|numeric|max:16|unique:users,nik',
            'nama' => 'required|max:50|string',
            'jk' => 'required',
            'email' => 'required|unique:users,email',
            'alamat' => 'required|max:100'
        ]);

        $user = new User();
        $user->nik = $request->nik;
        $user->name = $request->nama;
        $user->gender = $request->jk;
        $user->email = $request->email;
        $user->address =  $request->alamat;
        $user->assignRole('user');

        return dd($user);
    }
}
