<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;

use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::role('admin')->paginate(10);

        return view('admin.admin', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|min:5',
            'jk' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|string|min:8'
        ]);

        $admin = new User();
        $admin->name = $request->nama;
        $admin->gender = $request->jk;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->assignRole('admin');
        $admin->save();

        return redirect()->back();
    }

    public function destory($id)
    {
        $admin = User::where('id',$id)->first();

        $admin->delete();

        return redirect()->back();
    }

    public function profil()
    {

        $admin = User::where('id', Auth::user()->id)->first();

        return view('admin.profil',compact('admin'));
    }

    public function updateProfil(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|min:5|max:30'
        ]);

        $admin = User::where('id', Auth::user()->id)->first();

        $admin->name = $request->nama;
        $admin->save();

        return redirect()->back();
    }

    public function ubahPassword(Request $request)
    {

        $request->validate([
            'password_lama' => 'required', new MatchOldPassword,
            'password_baru' => 'required|min:8',
            'konfir_password_baru' => 'same:password_baru'
        ]);

        $admin = User::where('id', Auth::user()->id)->first();

        $admin->password = bcrypt($request->password_baru);
        $admin->save();

        return redirect()->back();

    }
}
