
<style>
    table{
        position: relative;
        border: 1px solid black;
    }

    .title{
        text-align: center;
    }
</style>

<h4 class="title">{{ $title }}</h4>

<hr>

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
        </tr>
    </thead>
    <tbody>
        @foreach ($kendaraan as $no => $data)
        <tr>
            <td class="text-bold-500">{{ $loop->iteration }}</td>
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
        </tr>
        @endforeach

    </tbody>
</table>

<script type="text/javascript">
    window.print();
</script>
