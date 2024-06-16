<!DOCTYPE html>
<html>
<head>
	<title>Stok Opname Gudang {{\App\Models\Gudang::find($selectedGudang)->nama}}</title>
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
        <td style="text-align: center; width: 700px;"><h3>Laporan Stok Opname Gudang {{\App\Models\Gudang::find($selectedGudang)->nama}}<h3></td>
    </tr>
    <table class="table table-bordered center-table" style="width: 700px;">
    <thead>
      <tr>
        <th style="text-align: center;">Tanggal</th>
        <th style="text-align: center;">Kode Barang</th>
        <th style="text-align: center;">Nama Barang</th>
        <th style="text-align: center;">Satuan</th>
        <th style="text-align: center;">Quantity Sistem</th>
        <th style="text-align: center;">Quantity Fisik</th>
        <th style="text-align: center;">Selisih</th>
        <th style="text-align: center;">Keterangan</th>
      </tr>
    </thead>
    <tbody>
    {{--Belum Dimodifikasi--}}
      @foreach($data as $d)
        <tr>
            @if($tglAwal != $tglAkhir)
                <td style="text-align: center;">{{date('d-m-Y', strtotime($d->tanggal))}}</td>
            @endif
            <td style="text-align: center;">{{$d->no_bukti}}</td>
            @if(count(array_unique($kodeBrgArray)) > 1)
                <td>{{$d->kode_brg}}</td>
                <td>{{$d->nama_brg}}</td>
            @endif
            <td style="text-align: center;">{{$d->satuan->satuan}}</td>
            @if($selectedGudang == "All")    
                <td style="text-align: center;">{{$d->gudang->nama}}</td>
            @endif
            <td style="text-align: center;">{{$d->stok_awal}}</td>
            <td style="text-align: center;">{{$d->qty_masuk}}</td>
            <td style="text-align: center;">{{$d->qty_keluar}}</td>
            <td style="text-align: center;">{{$d->qty_rusak_exp}}</td>
            <td style="text-align: center;">{{$d->stok_akhir}}</td>
        </tr>
      @endforeach
    </tbody>
    </table>
</table>
</body>
</html>