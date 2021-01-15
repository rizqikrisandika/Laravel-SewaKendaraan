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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = Kendaraan::orderBy('updated_at','desc')->paginate(10);
        $kategori = Kategori::all();


        return view('admin.kendaraan',compact('kendaraan','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan, $slug)
    {
        $kendaraan = Kendaraan::where('slug',$slug)->first();
        Storage::disk('public')->delete($kendaraan->gambar);
        Kendaraan::where('slug',$slug)->delete();

        return redirect()->back();
    }
}
