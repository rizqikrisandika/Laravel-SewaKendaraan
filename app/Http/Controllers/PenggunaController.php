<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::role('user')->paginate(10);

        return view('admin.pengguna', compact('user'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nik' => 'required|unique:users,nik|numeric|digits:16',
            'nama' => 'required|string|min:5',
            'jk' => 'required',
            'email' => 'required|unique:users,email|email',
            'nohp' => 'required|numeric|digits:12',
            'alamat' => 'required|string|max:100'
        ]);

        $user = new User();
        $user->nik = $request->nik;
        $user->name = $request->nama;
        $user->gender = $request->jk;
        $user->email = $request->email;
        $user->phone =  $request->nohp;
        $user->address =  $request->alamat;
        $user->assignRole('user');
        $user->save();

        return redirect()->back();
    }

    public function update()
    {

    }

    public function destory($id)
    {
        $user = User::where('id',$id)->first();

        $user->delete();

        return redirect()->back();
    }
}
