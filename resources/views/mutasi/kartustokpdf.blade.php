<!DOCTYPE html>
<html>
<head>
	<title>Kartu Stok</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            width: 700px;
            font-size: 10px;
        }
        .table-bordered, .table-bordered th, .table-bordered td {
            border: 2px solid black; 
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
    @if($tglAwal && $tglAkhir)
    <tr>
        <td style="text-align: center; width: 700px;">Tanggal {{$tglAwal}} s/d {{$tglAkhir}}</td>
    </tr>
    @endif<br>
    @if($selectedGudang != "All")
    <tr>
        <td><h4>{{\App\Models\Gudang::find($selectedGudang)->nama}}<h4></td>
    </tr>
    @else
    <br>
    @endif
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
    @if(count(array_unique($kodeBrgArray)) == 1)
        <tr>
            <td><h4>{{$kodeBrgArray[0]}} - {{$namaBrgArray[0]}}<h4></td>
        </tr>
    @endif
    <table class="table table-bordered center-table" style="width: 700px;">
      <tr>
        <th style="text-align: center;">Tanggal Mutasi</th>
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
      @foreach($data as $d)
        <tr>
            <td>{{date('d-m-Y', strtotime($d->tanggal))}}</td>
            <td>{{$d->no_bukti}}</td>
            @if(count(array_unique($kodeBrgArray)) > 1)
                <td>{{$d->kode_brg}}</td>
                <td>{{$d->nama_brg}}</td>
            @endif
            <td>{{$d->satuan->satuan}}</td>
            @if($selectedGudang == "All")    
                <td>{{$d->gudang->nama}}</td>
            @endif
            <td>{{$d->stok_awal}}</td>
            <td>{{$d->qty_masuk}}</td>
            <td>{{$d->qty_keluar}}</td>
            <td>{{$d->qty_rusak_exp}}</td>
            <td>{{$d->stok_akhir}}</td>
        </tr>
      @endforeach
      <tr>
        <td></td>
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
        <td>{{$totalMasuk}}</td>
        <td>{{$totalKeluar}}</td>
        <td>{{$totalRusak}}</td>
        <td></td>
      </tr>
    </table>
</table>
</body>
</html>