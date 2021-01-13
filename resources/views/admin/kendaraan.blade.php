@extends('layouts.app2')

@section('title','Kendaraan')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Data Kendaraan</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKendaraan">
                            + Kendaraan
                          </button>
                          {{-- Modal --}}
                          <div class="modal fade" id="modalTambahKendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kendaraan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    {{-- form --}}
                                    <form action="" method="post">
                                        @csrf
                                        <div class="form-group">
                                          <label for="nama">Nama</label>
                                          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kendaraan">
                                        </div>
                                        <div class="form-group">
                                          <label for="kategori">Kategori</label>
                                          <select class="form-control" name="kategori" id="kategori">
                                            <option selected>Jenis Kendaraan</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Plat Nomor</label>
                                            <input type="text" class="form-control" name="plat" id="exampleFormControlInput1" placeholder="AB 1234 XX">
                                          </div>
                                          <div class="form-group">
                                            <label for="exampleFormControlInput1">Harga/Hari</label>
                                            <input type="text" class="form-control" name="harga" id="exampleFormControlInput1" placeholder="Harga Sewa">
                                          </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Gambar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="gambar" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                              </div>
                                        </div>
                                      </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="button" class="btn btn-primary">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- endmodal --}}
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAME</th>
                                            <th>RATE</th>
                                            <th>SKILL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">Michael Right</td>
                                            <td>$15/hr</td>
                                            <td class="text-bold-500">UI/UX</td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Morgan Vanblum</td>
                                            <td>$13/hr</td>
                                            <td class="text-bold-500">Graphic concepts</td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Tiffani Blogz</td>
                                            <td>$15/hr</td>
                                            <td class="text-bold-500">Animation</td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Ashley Boul</td>
                                            <td>$15/hr</td>
                                            <td class="text-bold-500">Animation</td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Mikkey Mice</td>
                                            <td>$15/hr</td>
                                            <td class="text-bold-500">Animation</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
