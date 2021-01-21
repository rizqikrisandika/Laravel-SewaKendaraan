<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Kendaraan;

use function Ramsey\Uuid\v1;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_kendaraan()
    {
        return view('admin.laporan_kendaraan');
    }

    public function laporan_tanggal_kendaraan(Request $request)
    {

        $dari = Carbon::parse($request->dari)->format('Y-m-d')." 00:00:00";
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d')." 23:59:59";

        $title = "Laporan Data Kendaraan Tanggal ".$request->dari." Sampai ".$request->sampai;

        $kendaraan = Kendaraan::whereBetween('created_at',[$dari, $sampai])->get();

        return view('admin.cetak-kendaraan',compact('kendaraan','title'));
    }

    public function laporan_harian_kendaraan()
    {
        $sekarang = Carbon::now()->format('Y-m-d');
        $title = "Laporan Data Kendaraan Harian Pada Tanggal ".$sekarang;
        $kendaraan =  Kendaraan::whereDate('created_at','=',$sekarang)->get();

        return view('admin.cetak-kendaraan',compact('kendaraan','title'));
    }

    public function laporan_mingguan_kendaraan()
    {

        $dari = Carbon::now()->startOfWeek();
        $sampai = Carbon::now()->endOfWeek();

        $title = "Laporan Data Kendaraan Mingguan ".$dari." Sampai ".$sampai;

        $kendaraan = Kendaraan::whereBetween('created_at',[$dari, $sampai])->get();

        return view('admin.cetak-kendaraan',compact('kendaraan','title'));
    }

    public function laporan_bulanan_kendaraan()
    {
        $sekarang = Carbon::now()->format('m');
        $title = "Laporan Data Kendaraan Bulanan Pada Bulan ".$sekarang."-". date('Y');
        $kendaraan =  Kendaraan::whereMonth('created_at','=',$sekarang)->get();

        return view('admin.cetak-kendaraan',compact('kendaraan','title'));
    }

    public function laporan_tahunan_kendaraan()
    {
        $sekarang = Carbon::now()->format('Y');
        $title = "Laporan Data Kendaraan Tahunan Pada Tahun ".$sekarang;
        $kendaraan =  Kendaraan::whereYear('created_at','=',$sekarang)->get();

        return view('admin.cetak-kendaraan',compact('kendaraan','title'));
    }
}
