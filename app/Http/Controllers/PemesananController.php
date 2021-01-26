<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Pemesanan;
use App\User;
use App\Kendaraan;

class PemesananController extends Controller
{
    public function index()
    {
        $admin = User::role(['super admin','admin'])->first();
        $pemesanan = Pemesanan::latest()->paginate(10);
        $user = User::role('user')->where('created_by',$admin->id)->latest()->get();
        $kendaraan = Kendaraan::where('status','=',1)->get();

        return view('admin.pemesanan',compact('pemesanan','user','kendaraan'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'pengguna' => 'required',
            'kendaraan' => 'required',
            'dari' => 'required',
            'sampai' => 'required'
        ]);


        if($validasi->fails())
        {
            if($request->pengguna || $request->kendaraan == 0)
            {
                alert()->error('Tambah Pemesanan', 'Gagal!');

                return redirect()->back();
            }

            alert()->error('Tambah Pemesanan', 'Gagal!');

            return redirect()->back();
        }


        $admin = Auth::user();
        $kendaraan = Kendaraan::where('id',$request->kendaraan)->first();

        $dari_hitung = Carbon::parse($request->dari);
        $sampai_hitung = Carbon::parse($request->sampai);
        $hitung_hari = $dari_hitung->diffInDays($sampai_hitung)+1;
        $total_harga = $kendaraan->harga * $hitung_hari;

        $pemesanan = new Pemesanan();
        $pemesanan->user_id = $request->pengguna;
        $pemesanan->kendaraan_id = $request->kendaraan;
        $pemesanan->dari = $request->dari;
        $pemesanan->sampai = $request->sampai;
        $pemesanan->total_harga = $total_harga;
        $pemesanan->created_by = $admin->id;
        $pemesanan->save();

        $kendaraan->status = 0;
        $kendaraan->update();

        alert()->success('Tambah Pemesanan', 'Sukses');

        return redirect()->back();
    }

    public function update()
    {

    }

    public function destory($id)
    {
        $pemesanan = Pemesanan::where('id',$id)->first();
        $kendaraan = Kendaraan::where('id',$pemesanan->kendaraan_id)->first();
        $pemesanan->delete();

        $kendaraan->status = 1;
        $kendaraan->update();

        alert()->success('Hapus Pemesanan', 'Sukses');

        return redirect()->back();
    }

    public function cetakPemesanan()
    {

    }

    public function cetakBukti()
    {

    }
}
