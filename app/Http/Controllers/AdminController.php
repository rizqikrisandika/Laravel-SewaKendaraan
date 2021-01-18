<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
