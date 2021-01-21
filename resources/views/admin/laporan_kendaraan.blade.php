@extends('layouts.app2')

@section('title','Laporan Kendaraan')

@section('dashboard')


<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Laporan Kendaraan</h4>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Berdasarkan Tanggal</h4>

                        <form action="{{ route('tgl_laporankendaraan.admin') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dari">Dari</label>
                                        <input type="date" class="form-control" name="dari" id="date"
                                            >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sampai">Sampai</label>
                                        <input type="date" class="form-control" name="sampai" id="date"
                                            >
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Berdasarkan Harian</h4>

                                <form action="{{ route('tambahkategori.admin') }}" method="post">
                                    @csrf

                                    <button class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Berdasarkan Bulan</h4>

                                <form action="{{ route('tambahkategori.admin') }}" method="post">
                                    @csrf

                                    <button class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Berdasarkan Tahun</h4>

                                <form action="{{ route('tambahkategori.admin') }}" method="post">
                                    @csrf

                                    <button class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(function(){
          $("#date").datepicker({
             dateFormat:"dd-mm-yy",
          });
        });
        </script>


    @endsection
