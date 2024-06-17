<!DOCTYPE html>
<html>
<head>
@if($selectedGudang != "All")
	<title>Stok Opname {{ucwords(strtolower($selectedGudang))}}</title>
@else
    <title>Stok Opname Semua Gudang</title>
@endif
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            width: 700px;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-bordered tr,
        .table-bordered th,
        .table-bordered td  {
            border: 1px solid black;
        }
        h4{
            font-size: 14px;
        }
        h3{
            font-size: 24px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td><h4>PT. MASUYA GRAHA TRIKENCANA</h4></td>
    </tr>
    <tr>
        <td>User: 
        @auth
            {{auth()->user()->name}}
        @endauth</td> 
    </tr>    
    <tr>
        <td style="text-align: center; width: 700px;">
        @if($selectedGudang != "All")
            <h3>Laporan Stok Opname {{ucwords(strtolower($selectedGudang))}}<h3>
        @else
            <h3>Laporan Stok Opname Semua Gudang<h3>
        @endif                
        </td>
    </tr>
    <table class="table table-bordered center-table" style="width: 700px;">
    <thead>
      <tr>
        <th style="text-align: center;">Tanggal</th>
        <th style="text-align: center;">Kode Barang</th>
        <th style="text-align: center;">Nama Barang</th>
        <th style="text-align: center;">Satuan</th>
        @if($selectedGudang == "All")
            <th style="text-align: center;">Gudang</th>
        @endif
        <th style="text-align: center;">Quantity Sistem</th>
        <th style="text-align: center;">Quantity Fisik</th>
        <th style="text-align: center;">Selisih</th>
        <th style="text-align: center;">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)
        <tr>
            <td style="text-align: center;">{{$d->tanggal}}</td>
            <td>{{$d->kode_brg}}</td>
            <td>{{$d->nama_brg}}</td>
            <td style="text-align: center;">{{$d->satuan->satuan}}</td>
            @if($selectedGudang == "All")
                <td style="text-align: center;">{{$d->gudang->nama}}</td>
            @endif
            <td style="text-align: center;">{{$d->qty_sistem}}</td>
            <td style="text-align: center;">{{$d->qty_fisik}}</td>
            <td style="text-align: center;">{{$d->selisih}}</td>
            <td style="text-align: center;">{{$d->keterangan}}</td>
        </tr>
      @endforeach
    </tbody>
    </table>
</table>
</body>
</html>