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
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Harian</h4>

                                    <a href="{{ route('hr_laporankendaraan.admin') }}" class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></a>

                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Mingguan</h4>

                                    <a href="{{ route('mg_laporankendaraan.admin') }}" class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></a>

                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bulan</h4>

                                    <a href="{{ route('bl_laporankendaraan.admin') }}" class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></a>

                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tahun</h4>
                                    <a href="{{ route('th_laporankendaraan.admin') }}" class="btn btn-primary float-right d-block"><i class="fas fa-print"></i></a>
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
