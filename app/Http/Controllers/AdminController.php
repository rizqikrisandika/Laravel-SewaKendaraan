<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Validator;

use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = User::role('admin')->paginate(10);

        return view('admin.admin', compact('admin'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:30',
            'jk' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails())
        {

            alert()->error('Menambah Admin', 'Gagal!');

            return redirect()->back();
        }

        $admin = new User();
        $admin->name = $request->nama;
        $admin->gender = $request->jk;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->assignRole('admin');
        $admin->save();

        alert()->success('Tambah Admin', 'Sukses');

        return redirect()->back();
    }

    public function destory($id)
    {
        User::where('id',$id)->delete();

        alert()->success('Hapus Admin', 'Sukses');

        return redirect()->back();
    }

    public function profil()
    {

        $admin = User::where('id', Auth::user()->id)->first();

        return view('admin.profil',compact('admin'));
    }

    public function updateProfil(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:30'
        ]);

        if($validator->fails())
        {

            alert()->error('Ubah Profil', 'Gagal!');

            return redirect()->back();
        }

        $admin = User::where('id', Auth::user()->id)->first();

        $admin->name = $request->nama;
        $admin->save();

        alert()->success('Ubah Profil', 'Sukses');

        return redirect()->back();
    }

    public function ubahPassword(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'password_lama' => 'required', new MatchOldPassword,
            'password_baru' => 'required|min:8',
            'konfir_password_baru' => 'same:password_baru'
        ]);

        if($validator->fails())
        {

            alert()->error('Ubah Password', 'Gagal!');

            return redirect()->back();
        }

        $admin = User::where('id', Auth::user()->id)->first();

        $admin->password = bcrypt($request->password_baru);
        $admin->save();

        alert()->success('Ubah Password', 'Sukses');

        return redirect()->back();

    }
}
