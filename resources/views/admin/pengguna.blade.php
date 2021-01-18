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
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalTambahPengguna">
                        + Pengguna
                    </button>

                     {{-- Modal --}}
                     <div class="modal fade" id="modalTambahPengguna" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pengguna</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 {{-- form --}}
                                 <form action="{{ route('tambahpengguna.admin') }}" method="post"
                                     enctype="multipart/form-data">
                                     @csrf
                                     <div class="form-group">
                                         <label for="nik">NIK</label>
                                         <input type="text" class="form-control" name="nik" id="nik"
                                             placeholder="34040123049XXXX" maxlength="16" value="{{ old('nik') }}">
                                     </div>
                                     <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            placeholder="Nama Pengguna" value="{{ old('nama') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="pria">Pria</option>
                                            <option value="wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="nama@sewa.com" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">No Hp</label>
                                        <input type="text" class="form-control" name="nohp" id="nohp"
                                            placeholder="08121212XX" maxlength="12" value="{{ old('nohp') }}">
                                    </div>
                                     <div class="form-group">
                                         <label for="alamat">Alamat</label>
                                         <input type="text" class="form-control" name="alamat"
                                             id="exampleFormControlInput1" value="{{ old('alamat') }}"
                                             placeholder="Alamat Sekarang">
                                     </div>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary"
                                     data-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Simpan</button>
                                 </form>
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
                                            <th>NIK</th>
                                            <th>NAMA</th>
                                            <th>EMAIL</th>
                                            <th>NOHP</th>
                                            <th>JK</th>
                                            <th>ALAMAT</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $no => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $user->firstItem()+$no }}</td>
                                            <td><img src="" style="width: 100px"
                                                    alt="">{{ $data->nik }}</td>
                                            <td class="text-bold-500">{{ $data->name }}</td>
                                            <td class="text-bold-500">{{ $data->email }}</td>
                                            <td class="text-bold-500">{{ $data->phone }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td class="text-bold-500">{{ $data->address }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modalHapusPengguna{{ $data->id }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>


                                        {{-- Modal Hapus --}}

                                        <div class="modal fade" id="modalHapusPengguna{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi
                                                            Hapus
                                                            Pengguna</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin untuk menghapus pengguna {{ $data->name }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- form --}}
                                                        <form
                                                            action="{{ route('hapuspengguna.admin',['id'=>$data->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tidak</button>
                                                            <button type="submit" class="btn btn-danger">Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- endModal --}}

                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $user->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
