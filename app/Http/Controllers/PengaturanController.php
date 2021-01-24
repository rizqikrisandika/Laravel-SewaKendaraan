<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Whatsapp;

class PengaturanController extends Controller
{
    public function whatsappIndex()
    {
        $whatsapp = Whatsapp::all();

        return view('admin.set-whatsapp',compact('whatsapp'));
    }

    public function storeWhatsapp(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nomor' => 'required|max:13'
        ]);

        if($validasi->fails())
        {
            alert()->error('Tambah Nomor', 'Gagal!');

            return redirect()->back();
        }

        $wa = new Whatsapp();
        $wa->nomor = $request->nomor;
        $wa->save();

        alert()->success('Tambah Nomor', 'Sukses');

        return redirect()->back();
    }

    public function updateWhatsapp(Request $request,$id)
    {
        $validasi = Validator::make($request->all(),[
            'nomor' => 'required|max:13'
        ]);

        if($validasi->fails())
        {
            alert()->error('Ubah Nomor', 'Gagal!');

            return redirect()->back();
        }

        $wa = Whatsapp::where('id',$id)->first();
        $wa->nomor = $request->nomor;
        $wa->save();

        alert()->success('Ubah Nomor', 'Sukses');

        return redirect()->back();
    }

    public function deleteWhatsapp($id)
    {
        $wa = Whatsapp::where('id',$id)->first();
        $wa->delete();

        alert()->success('Hapus Nomor', 'Sukses');

        return redirect()->back();
    }
}
