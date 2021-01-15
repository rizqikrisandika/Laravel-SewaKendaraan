@extends('layouts.app2')

@section('title','Kendaraan')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Data Pengguna</h4>

                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NIK</th>
                                            <th>NAMA</th>
                                            <th>EMAIL</th>
                                            <th>JK</th>
                                            <th>ALAMAT</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($kendaraan as $no => $data) --}}
                                        <tr>
                                            <td class="text-bold-500"></td>
                                            <td><img src="" style="width: 100px"
                                                    alt=""></td>
                                            <td class="text-bold-500"></td>
                                            <td class="text-bold-500"></td>
                                            <td></td>
                                            <td class="text-bold-500"></td>
                                            <td>

                                            </td>
                                        </tr>

                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>

                                {{-- {{ $kendaraan->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
