@extends('layout')
@section('title','Detail Penjualan')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .table {
      border: 2px solid #000000;
    }
    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
      border: 2px solid black !important;
    }
    th{
        text-align: center;
    } 
  </style>
</head>

<div class="mt-5">
<div style="margin-left: 20px;">
    <h3 style="display: inline-block; margin-right: 20px;">Detail Penjualan - {{$no_bukti}}</h3>
</div><br>

<div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Quantity</th>
        <th>Satuan</th>
        <th>Harga Per Unit</th>
        <th>Harga Total</th>
        <th>Asal Gudang</th>
      </tr>
    </thead>
    <tbody>
        @foreach($jualDetail as $j)
            <tr id="tr_{{$j->kode_brg}}">
                <td>{{$j->kode_brg}}</td>
                <td>{{$j->nama_brg}}</td>
                <td>{{$j->qty_order}}</td>
                <td>{{$j->satuan->satuan}}</td>
                <td>Rp. {{number_format($j->hrg_per_unit, 0, ',', '.')}}</td>
                <td>Rp. {{number_format($j->hrg_total, 0, ',', '.')}}</td>
                <td>{{$j->gudang->nama}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection