<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Kendaraan;
use App\Kategori;

class KendaraanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kendaraan = Kendaraan::orderBy('updated_at','desc')->paginate(10);
        $kategori = Kategori::all();


        return view('admin.kendaraan',compact('kendaraan','kategori'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|max:30|unique:kendaraan,nama',
            'kategori' => 'required',
            'plat' => 'required|unique:kendaraan,plat',
            'harga' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:4096'
        ];

        $message = [
            'required' => ':attribute tidak boleh kosong!',
            'unique' => 'Plat :attribute sudah digunakan!'
        ];


        $request->validate($rules, $message);

        $user_id = Auth::user()->id;

        $extensiGambar = $request->gambar->extension();
        $namaGambar = 'img_'.time().'.'.$extensiGambar;

        $lokasiGambar = $request->gambar->storeAs('gambar',$namaGambar,'public');

        $format_harga = preg_replace('/\D/','',$request->harga);

        $kendaraan = new Kendaraan();
        $kendaraan->nama = $request->nama;
        $kendaraan->slug = Str::slug($request->nama);
        $kendaraan->plat = $request->plat;
        $kendaraan->harga = $format_harga;
        $kendaraan->gambar = $lokasiGambar;
        $kendaraan->status = 1;
        $kendaraan->kategori_id = $request->kategori;
        $kendaraan->user_id = $user_id;
        $kendaraan->save();

        alert()->success('Tambah Kendaraan', 'Sukses');

        return redirect()->back();
    }

    public function update(Request $request, Kendaraan $kendaraan, $slug)
    {
        $rules = [
            'nama' => 'required|max:30',
            'kategori' => 'required',
            'plat' => 'required',
            'harga' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:4096'
        ];

        $message = [
            'required' => ':attribute tidak boleh kosong!',
            'unique' => 'Plat :attribute sudah digunakan!'
        ];

        $request->validate($rules, $message);

        $kendaraan = Kendaraan::where('slug', $slug)->first();

        if($request->gambar)
        {

            $extensiGambar = $request->gambar->extension();
            $namaGambar = 'img_'.time().'.'.$extensiGambar;
            $lokasiGambar = $request->gambar->storeAs('gambar',$namaGambar,'public');

            $format_harga = preg_replace('/\D/','',$request->harga);
            Storage::disk('public')->delete($kendaraan->gambar);

            $kendaraan->nama = $request->nama;
            $kendaraan->slug = Str::slug($request->nama);
            $kendaraan->plat = $request->plat;
            $kendaraan->harga = $format_harga;
            $kendaraan->gambar = $lokasiGambar;
            $kendaraan->kategori_id = $request->kategori;
            $kendaraan->save();
        }else{

            $format_harga = preg_replace('/\D/','',$request->harga);

            $kendaraan->nama = $request->nama;
            $kendaraan->slug = Str::slug($request->nama);
            $kendaraan->plat = $request->plat;
            $kendaraan->harga = $format_harga;
            $kendaraan->kategori_id = $request->kategori;
            $kendaraan->save();
        }

        alert()->success('Ubah Kendaraan', 'Sukses');

        return redirect()->back();
    }

    public function destroy(Kendaraan $kendaraan, $slug)
    {
        $kendaraan = Kendaraan::where('slug',$slug)->first();
        Storage::disk('public')->delete($kendaraan->gambar);
        Kendaraan::where('slug',$slug)->delete();

        alert()->success('Hapus Kendaraan', 'Sukses');

        return redirect()->back();
    }

    public function cetak()
    {
        $title = "Laporan Data Seluruh Kendaraan";
        $kendaraan = Kendaraan::all();

        return view('admin.cetak-kendaraan',compact('kendaraan','title'));
    }

    public function index_kategori($id)
    {
        $kategori = Kategori::all();

        $kendaraan = Kendaraan::where('kategori_id',$id)->paginate(10);

        return view('admin.kendaraan',compact('kategori','kendaraan'));
    }
}
