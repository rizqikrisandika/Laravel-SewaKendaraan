@extends('layouts.app2')

@section('title','Pemesanan')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Data Pemesanan</h4>
                        <div>
                            <a type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalTambahPemesanan">
                                + Pemesanan
                            </a>
                            <a name="" id="" class="btn btn-success" href="{{ route('cetakpemesanan.admin') }}"
                                role="button"><i class="fas fa-print"></i> Semua</a>
                            <a href="{{ route('pemesanan.admin') }}" type="button" class="btn btn-warning" ><i
                                    class="fas fa-sync"></i> Semua</a>

                            <div class="btn-group">
                                <a type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Kategori
                                </a>
                                <div class="dropdown-menu">

                                    <a class="dropdown-item"
                                        href="">gyweyew</a>

                                </div>
                            </div>
                        </div>



                        {{-- Modal --}}
                        <div class="modal fade" id="modalTambahPemesanan" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pemesanan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- form --}}
                                        <form action="{{ route('tambahpemesanan.admin') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    placeholder="Nama Pemesanan" value="{{ old('nama') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select class="form-control" name="kategori" id="kategori">
                                                    <option selected>Jenis Pemesanan</option>
                                                    @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Plat Nomor</label>
                                                <input type="text" class="form-control" name="plat"
                                                    id="exampleFormControlInput1" value="{{ old('plat') }}"
                                                    placeholder="AB 1234 XX">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Harga/Hari</label>
                                                <input type="text" class="form-control" name="harga" id="rupiah2"
                                                    value="{{ old('harga') }}" placeholder="Rp.">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Gambar</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="gambar"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
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
                            <h4 class="card-title">{{ $title }}</h4>
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>GAMBAR</th>
                                            <th>NAMA</th>
                                            <th>PLAT</th>
                                            <th>KATEGORI</th>
                                            <th>HARGA/HARI</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Pemesanan as $no => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $Pemesanan->firstItem()+$no }}</td>
                                            <td><img src="{{ url(Storage::url($data->gambar)) }}" style="width: 100px"
                                                    alt=""></td>
                                            <td class="text-bold-500">{{ $data->nama }}</td>
                                            <td class="text-bold-500">{{ $data->plat }}</td>
                                            <td>{{ $data->kategori->nama }}</td>
                                            <td class="text-bold-500">Rp. {{ number_format($data->harga,0,'.','.') }}
                                            </td>
                                            <td>
                                                @if ($data->status == 1)
                                                <span class="badge badge-success">Tersedia</span>
                                                @else
                                                <span class="badge badge-danger">Disewa</span>
                                                @endif
                                            </td>
                                            <td class="text-bold-500">
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#modalUbahPemesanan{{ $data->slug }}"><i
                                                        class="fa fa-pen"></i></button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modalHapusPemesanan{{ $data->slug }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        {{-- Modal Update--}}
                                        <div class="modal fade" id="modalUbahPemesanan{{ $data->slug }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah
                                                            Pemesanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form
                                                                action="{{ route('updatepemesanan.admin',['id' => $data->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="col">
                                                                    <label for="exampleFormControlInput1">Gambar</label>
                                                                    <div class="form-group">
                                                                        <img src="{{ url(Storage::url($data->gambar)) }}"
                                                                            style="width: 20vw" alt="">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input"
                                                                                name="gambar" id="customFile">
                                                                            <label class="custom-file-label"
                                                                                for="customFile">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nama" id="nama"
                                                                            placeholder="Nama Pemesanan"
                                                                            value="{{ $data->nama }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kategori">Kategori</label>
                                                                        <select class="form-control" name="kategori"
                                                                            id="kategori">
                                                                            <option value="{{ $data->kategori_id }}"
                                                                                selected>{{ $data->kategori->nama }}
                                                                            </option>
                                                                            @foreach ($kategori as $kat)
                                                                            <option value="{{ $kat->id }}">
                                                                                {{ $kat->nama }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1">Plat
                                                                            Nomor</label>
                                                                        <input type="text" class="form-control"
                                                                            name="plat" id="exampleFormControlInput1"
                                                                            value="{{ $data->plat }}"
                                                                            placeholder="AB 1234 XX">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleFormControlInput1">Harga/Hari</label>
                                                                        <input type="text" class="form-control"
                                                                            name="harga" id="rupiah3"
                                                                            value="Rp. {{ number_format($data->harga,0,'.','.') }}"
                                                                            placeholder="Rp.">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        {{-- form --}}



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

                                        {{-- Modal Hapus --}}

                                        <div class="modal fade" id="modalHapusPemesanan{{ $data->slug }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi
                                                            Hapus
                                                            Pemesanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin untuk menghapus Pemesanan {{ $data->nama }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- form --}}
                                                        <form
                                                            action="{{ route('hapuspemesanan.admin',['id'=>$data->id]) }}"
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
                                                <td class="text-center" colspan="8">Data kosong / tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $Pemesanan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
