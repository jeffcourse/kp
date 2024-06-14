<!DOCTYPE html>
<html>
@php
    $kodeBrgArray = [];
    $namaBrgArray = [];
@endphp
@foreach($data as $d)
    @php
        $kodeBrgArray[] = $d->kode_brg;
        $namaBrgArray[] = $d->nama_brg;
    @endphp
@endforeach
<head>
    @if(count(array_unique($kodeBrgArray)) != 1)
	    <title>Kartu Stok</title>
    @else
        <title>Kartu Stok - {{$kodeBrgArray[0]}} - {{$namaBrgArray[0]}}</title>
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
        <td style="text-align: center; width: 700px;"><h3>Kartu Stok<h3></td>
    </tr>
    @if($tglAwal != $tglAkhir)
    <tr>
        <td style="text-align: center; width: 700px;">Tanggal {{$tglAwal}} s/d {{$tglAkhir}}</td>
    </tr>
    @elseif($tglAwal == $tglAkhir)
    <tr>
        <td style="text-align: center; width: 700px;">Tanggal {{$tglAwal}}</td>
    </tr>
    @endif<br>
    @if($selectedGudang != "All")
    <tr>
        <td><h4>{{\App\Models\Gudang::find($selectedGudang)->nama}}<h4></td>
    </tr>
    @else
    <br>
    @endif
    @if(count(array_unique($kodeBrgArray)) == 1)
        <tr>
            <td><h4>{{$kodeBrgArray[0]}} - {{$namaBrgArray[0]}}<h4></td>
        </tr>
    @endif
    <table class="table table-bordered center-table" style="width: 700px;">
    <thead>
      <tr>
        @if($tglAwal != $tglAkhir)
            <th style="text-align: center;">Tanggal Mutasi</th>
        @endif
        <th style="text-align: center;">Nomor Nota</th>
        @if(count(array_unique($kodeBrgArray)) > 1)
            <th style="text-align: center;">Kode Barang</th>
            <th style="text-align: center;">Nama Barang</th>
        @endif
        <th style="text-align: center;">Satuan</th>
        @if($selectedGudang == "All")
            <th style="text-align: center;">Gudang</th>
        @endif
        <th style="text-align: center;">Stok Awal</th>
        <th style="text-align: center;">Masuk</th>
        <th style="text-align: center;">Keluar</th>
        <th style="text-align: center;">Rusak/EXP</th>
        <th style="text-align: center;">Stok Akhir</th>
      </tr>
    </thead>
    <tbody>
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
    <tfoot>
      <tr>
        @if($tglAwal != $tglAkhir)
            <td></td>
        @endif
        <td></td>
        @if(count(array_unique($kodeBrgArray)) > 1)
            <td></td>
            <td></td>
        @endif
        <td></td>
        @if($selectedGudang == "All")
            <td></td>
        @endif
        <td></td>
        <td style="text-align: center;">{{$totalMasuk}}</td>
        <td style="text-align: center;">{{$totalKeluar}}</td>
        <td style="text-align: center;">{{$totalRusak}}</td>
        <td></td>
      </tr>
    </tfoot>
    </table>
</table>
</body>
</html>