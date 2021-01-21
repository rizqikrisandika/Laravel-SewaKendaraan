<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategori = Kategori::orderBy('updated_at','desc')->paginate(5);

        return view('admin.kategori',compact('kategori'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required'
        ];

        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];

        $request->validate($rules, $message);

        $kategori = new Kategori();
        $kategori->nama = $request->nama;
        $kategori->slug = Str::slug($request->nama);
        $kategori->save();

        alert()->success('Tambah Kategori', 'Sukses');

        return redirect()->route('kategori.admin');
    }

    public function update(Request $request, $slug)
    {
        $kategori = Kategori::where('slug',$slug)->first();
        $kategori->nama = $request->nama;
        $kategori->slug = Str::slug($request->nama);
        $kategori->save();

        alert()->success('Ubah Kategori', 'Sukses');

        return redirect()->back();
    }

    public function destroy(Kategori $kategori, $slug)
    {
        $kategori = Kategori::where('slug',$slug)->first();
        $kategori->delete();

        alert()->success('Hapus Kategori', 'Sukses');

        return redirect()->back();
    }
}
