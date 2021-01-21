<!doctype html>
<html lang="en">

<head>
    <title>Bukti Pemesanan</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<h4 class="text-center">{{ $title }}</h4>

<hr>

<table class="table table-bordered">
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
            <td><img src="{{ url(Storage::url($data->gambar)) }}" style="width: 100px" alt=""></td>
            <td class="text-bold-500">{{ $data->nama }}</td>
            <td class="text-bold-500">{{ $data->plat }}</td>
            <td>{{ $data->kategori->nama }}</td>
            <td class="text-bold-500">Rp. {{ number_format($data->harga,0,'.','.') }}
            </td>
            <td>
                @if ($data->status == 1)
                Tersedia
                @else
                Disewa
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<script type="text/javascript">
    window.print();

</script>

</body>

</html>
