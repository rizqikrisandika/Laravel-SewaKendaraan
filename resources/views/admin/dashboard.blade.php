@extends('layouts.app2')

@section('title','Dashboard')

@section('dashboard')
<div class="content transition">
    <div class="container-fluid dashboard">
        <h3>Dashboard</h3>

        <div class="row">


            <div class="col-12 p-0">
                <div class="card-body">
                    <div class="alert alert-primary d-block" role="alert">
                        <h3 class="alert-heading">
                            @role('super admin')
                            Super Admin
                            @else
                            Admin
                            @endrole
                        </h3>
                        <h5 class="alert-heading">
                            {{ Auth::user()->name }}
                        </h5>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="las la-car icon-home bg-primary text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Kendaraan</p>
                                <h5>{{ $kendaraan }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="las la-clipboard-list icon-home bg-success text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Pesanan</p>
                                <h5>{{ $pemesanan }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="las la-chart-bar  icon-home bg-info text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Sales</p>
                                <h5>0</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="las la-id-card  icon-home bg-warning text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>User</p>
                                <h5>{{ $user }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="las la-id-card  icon-home bg-danger text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Admin</p>
                                <h5>{{ $admin }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

</div>
@endsection
