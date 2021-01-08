<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        h3, p, table {
            text-align: center;
            margin:0 auto;
        }
        h3, p {
            padding-bottom: 5px;
        }
        table thead tr th {
            border:1px solid;
            padding: 5px 15px;
        }
        table tbody tr td {
            border:1px solid;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <h3>REKAPITULASI PEMINJAMAN</h3>
    <h3>YAYASAN ALGHIFARI</h3>
    <p>Bulan : {{$bulan.' '.$tahun}}</p>
    <table class="table" cellspacing=0>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari & Tanggal</th>
                <th>Lembaga</th>
                <th>Penanggung Jawab</th>
                <th>Waktu Pinjam</th>
                <th>Acara</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if(count($peminjaman)>0)
            @foreach ($peminjaman as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->created_at->format('d/m/Y')}}</td>
                <td>{{$item->lembaga->lembaga}}</td>
                <td>{{$item->tanggal_mulai->format('d/m/Y').' s/d '.$item->tanggal_selesai->format('d/m/Y')}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->tujuan_penggunaan}}</td>
                <td>{{$item->txt_status}}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7">Data Kosong</td>
            </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
