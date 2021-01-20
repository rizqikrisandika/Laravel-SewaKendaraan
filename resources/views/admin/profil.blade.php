@extends('layouts.app2')

@section('title','Profil')

@section('dashboard')
<div class="content transition">
    <div class="container-fluid dashboard">
        <h3>Profile</h3>

            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                  <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                      <a class="list-group-item list-group-item-action active1" data-toggle="list" href="#account-general">General</a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="account-general">
                        <p class="mt-4 text-center">Information : </p>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <form action="{{ route('ubahprofil.admin') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                  <label class="form-label">Name</label>
                                  <input type="text" class="form-control" name="nama" value="{{ $admin->name }}">
                                </div>
                                <div class="form-group">
                                  <label class="form-label">E-mail</label>
                                  <input disabled type="text" class="form-control mb-1" value="{{ $admin->email }}">
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
                                </div>
                            </form>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="account-change-password">
                        <p class="mt-4 text-center">Change Password : </p>

                        <div class="card-body pb-2">
                            <form action="{{ route('ubahpassword.admin') }}" method="post">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                  <label class="form-label">Current password</label>
                                  <input type="password" name="password_lama" class="form-control">
                                </div>

                                <div class="form-group">
                                  <label class="form-label">New password</label>
                                  <input type="password" name="password_baru" class="form-control">
                                </div>

                                <div class="form-group">
                                  <label class="form-label">Repeat new password</label>
                                  <input type="password" name="konfir_password_baru" class="form-control">
                                </div>


                              <div class="text-right mt-3">
                                  <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                              </div>
                            </form>

                        </div>
                      </div>


                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        </div>
@endsection
