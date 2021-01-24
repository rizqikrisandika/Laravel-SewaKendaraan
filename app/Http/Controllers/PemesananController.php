<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PemesananController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $dari_hitung = Carbon::parse($request->dari);
        $sampai_hitung = Carbon::parse($request->sampai);

        $hitung_hari = $dari_hitung->diffInDays($sampai_hitung)+1;
    }

    public function update()
    {

    }

    public function destory()
    {

    }

    public function cetakPemesanan()
    {

    }

    public function cetakBukti()
    {

    }
}
