@extends('layouts.app2')

@section('title','Kategori')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Data Kategori</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modalTambahKategori">
                            + Kategori
                        </button>

                        {{-- Modal Tambah --}}
                        <div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- form --}}
                                        <form action="{{ route('tambahkategori.admin') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    value="{{ old('nama') }}" placeholder="Motor, Mobil, Shuttle, Bus">
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
                        {{-- endModal --}}

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
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kategori as $no => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $kategori->firstItem()+$no }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td class="text-bold-500">
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#modalUbahKategori{{ $data->slug }}"><i class="fa fa-pen"></i></button>

                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modalHapusKategori{{ $data->slug }}"><i class="fa fa-trash"></i></button>
                                            </td>

                                        </tr>

                                        {{-- Modal Ubah --}}

                                        <div class="modal fade" id="modalUbahKategori{{ $data->slug }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah
                                                            Kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- form --}}
                                                        <form
                                                            action="{{ route('updatekategori.admin',['slug'=>$data->slug]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" value="{{ $data->nama }}"
                                                                    placeholder="Motor, Mobil, Shuttle, Bus">
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
                                        {{-- endModal --}}

                                        {{-- Modal Hapus --}}

                                        <div class="modal fade" id="modalHapusKategori{{ $data->slug }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi
                                                            Hapus
                                                            Kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin untuk menghapus kategori {{ $data->nama }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- form --}}
                                                        <form
                                                            action="{{ route('hapuskategori.admin',['slug'=>$data->slug]) }}"
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
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3">Data kosong / tidak ditemukan</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                {{ $kategori->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
