@extends('layouts.app2')

@section('title','Pengturan Whatsapp')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Data Whatsapp</h4>
                        @if (!$whatsapp->count())
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modalTambahWhatsapp">
                            + Whatsapp
                        </button>
                        @endif

                        {{-- Modal Tambah --}}
                        <div class="modal fade" id="modalTambahWhatsapp" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Whatsapp</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- form --}}
                                        <form action="{{ route('wa-tambah.admin') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nomor">Nomor</label>
                                                <input type="text" class="form-control" name="nomor" id="nomor"
                                                    value="{{ old('nomor') }}" placeholder="6295123456789" maxlength="13">
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
                                            <th>NOMOR</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($whatsapp as $wa)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td>{{ $wa->nomor }}</td>
                                            <td class="text-bold-500">
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#modalUbahWhatsapp{{ $wa->id }}"><i class="fa fa-pen"></i></button>

                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modalHapusWhatsapp{{ $wa->id }}"><i class="fa fa-trash"></i></button>
                                            </td>

                                        </tr>

                                        {{-- Modal Ubah --}}

                                        <div class="modal fade" id="modalUbahWhatsapp{{ $wa->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah
                                                            Whatsapp</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- form --}}
                                                        <form
                                                            action="{{ route('wa-ubah.admin',['id'=>$wa->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-group">
                                                                <label for="nomor">Nomor</label>
                                                                <input type="text" class="form-control" name="nomor"
                                                                    id="nomor" value="{{ $wa->nomor }}"
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

                                        <div class="modal fade" id="modalHapusWhatsapp{{ $wa->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi
                                                            Hapus
                                                            Whatsapp</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin untuk menghapus nomor {{ $wa->nomor }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- form --}}
                                                        <form
                                                            action="{{ route('wa-hapus.admin',['id'=>$wa->id]) }}"
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
                                            <td class="text-center" colspan="3">Data Kosong</td>
                                        </tr>



                                        @endforelse

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
