@extends('layouts.app2')

@section('title','Pemesanan')

@section('dashboard')

<div class="content transition">
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pemesanan</h4>
                        <a type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modalTambahPemesanan"><i class="fas fa-plus"></i> Pemesanan</a>
                        <a name="" id="" class="btn btn-success" href="{{ route('cetakpemesanan.admin') }}"
                            role="button"><i class="fas fa-print"></i> Semua</a>
                        <a href="{{ route('pemesanan.admin') }}" type="button" class="btn btn-warning"><i
                                class="fas fa-sync"></i> Semua</a>

                        <div class="btn-group">
                            <a type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Kategori
                            </a>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="">gyweyew</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Pemesanan</h4>

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
                                                <label for="pengguna">Pengguna</label>
                                                <select class="form-control" name="pengguna" id="pengguna">
                                                    <option value="0" selected disabled>--Pilih--</option>
                                                    @foreach ($user as $us)
                                                    <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kendaraan">Kendaraan</label>
                                                <select class="form-control" name="kendaraan" id="kendaraan">
                                                    <option value="0" selected disabled>--Pilih--</option>
                                                    @foreach ($kendaraan as $ken)
                                                    <option value="{{ $ken->id }}">{{ $ken->nama }} (Rp.
                                                        {{ number_format($ken->harga,0,",",".")}}/Hari)</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="dari">Dari</label>
                                                        <input type="date" class="form-control" name="dari" id="dari"
                                                            value="{{ old('dari') }}">
                                                    </div>

                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="sampai">Sampai</label>
                                                        <input type="date" class="form-control" name="sampai"
                                                            id="sampai" value="{{ old('sampai') }}">
                                                    </div>
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
                            {{-- <h4 class="card-title">{{ $title }}</h4> --}}

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>INVOICE</th>
                                            <th>PENGGUNA</th>
                                            <th>KENDARAAN</th>
                                            <th>HARI</th>
                                            <th>TOTAL</th>
                                            <th>ALAMAT</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pemesanan as $no => $data)
                                        <tr>
                                            <td>{{ $pemesanan->firstItem()+$no }}</td>
                                            <td>{{ $data->invoice }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->kendaraan->nama }}</td>
                                            <td>
                                                @php
                                                $dari_hitung = Carbon\Carbon::parse($data->dari);
                                                $sampai_hitung = Carbon\Carbon::parse($data->sampai);
                                                $hitung_hari = $dari_hitung->diffInDays($sampai_hitung)+1;
                                                @endphp
                                                {{ $hitung_hari }}
                                            </td>
                                            <td>Rp. {{ number_format($data->total_harga,0,",",".") }}</td>
                                            <td>
                                                @if ($data->alamat == NULL)
                                                Ditempat
                                                @else
                                                {{ $data->alamat }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->status == 0)
                                                    <span class="badge badge-warning">Menyewa</span>
                                                @else
                                                    <span class="badge badge-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#modalCetakPemesanan{{ $data->id }}"><i
                                                        class="fa fa-print"></i></button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modalHapusPemesanan{{ $data->id }}"><i
                                                        class="fa fa-trash"></i></button>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#modalDetailPemesanan{{ $data->id }}"><i
                                                        class="fa fa-search"></i></button>
                                            </td>
                                        </tr>

                                        {{-- Modal Hapus --}}

                                        <div class="modal fade" id="modalCetakPemesanan{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Cetak Pemesanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin untuk mencetak pemesanan?
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
                                                            <button type="submit" class="btn btn-success">Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- endModal --}}


                                        {{-- Modal Hapus --}}

                                        <div class="modal fade" id="modalHapusPemesanan{{ $data->id }}" tabindex="-1"
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
                                                        Apakah anda yakin untuk menghapus pemesanan oleh {{ $data->user->name }} dengan kendaraan {{ $data->kendaraan->nama }}?
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

                                {{ $pemesanan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
