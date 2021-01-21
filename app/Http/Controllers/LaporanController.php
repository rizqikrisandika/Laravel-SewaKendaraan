<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Kendaraan;

class LaporanController extends Controller
{
    public function __construct()
    {

    }

    public function index_kendaraan()
    {
        return view('admin.laporan_kendaraan');
    }

    public function laporan_tanggal_kendaraan(Request $request)
    {

        $dari = Carbon::parse($request->dari)->format('Y-m-d')." 00:00:00";
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d')." 23:59:59";

        $kendaraan = Kendaraan::whereBetween('created_at',[$dari, $sampai])->get();

        return view('admin.cetak-kendaraan',compact('kendaraan'));
    }
}
