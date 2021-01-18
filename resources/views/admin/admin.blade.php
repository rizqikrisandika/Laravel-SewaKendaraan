@extends('layouts.app2')

@section('title','Admin')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Data Admin</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalTambahAdmin">
                        + Admin
                    </button>

                     {{-- Modal --}}
                     <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLongTitle">Tambah Admin</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 {{-- form --}}
                                 <form action="{{ route('tambahadmin.admin') }}" method="post"
                                     enctype="multipart/form-data">
                                     @csrf
                                     <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            placeholder="Nama Admin" value="{{ old('nama') }}">
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
                                         <label for="password">Password</label>
                                         <input type="password" class="form-control" name="password"
                                             id="exampleFormControlInput1" value="{{ old('password') }}"
                                             placeholder="Masukkan Password">
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
                                            <th>NAMA</th>
                                            <th>EMAIL</th>
                                            <th>JK</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin as $no => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $admin->firstItem()+$no }}</td>
                                            <td class="text-bold-500">{{ $data->name }}</td>
                                            <td class="text-bold-500">{{ $data->email }}</td>
                                            <td>{{ $data->gender }}</td>
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
                                                            Admin</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin untuk menghapus admin {{ $data->name }}?
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

                                {{ $admin->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
