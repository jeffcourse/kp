@extends('layout')
@section('title','Master')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<div class="mt-5">
<div style="margin-left: 40px;">
    <h3 style="display: inline-block; margin-right: 20px;">Master Table</h3>
    <a href="{{route('master.create')}}" class="btn btn-success">Tambah Barang</a><br>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<table class="table" style="margin-left: 40px; margin-right: 80px;">
    <thead>
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Divisi</th>
        <th>Jenis Barang</th>
        <th>Tipe Barang</th>
        <th>Packing</th>
        <th>Quantity</th>
        <th>Harga Jual Per Pack</th>
        <th>Harga Jual Total</th>
        <th>Gudang</th>
        <th>Keterangan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($master as $m)
            <tr id="tr_{{$m->kode_brg}}">
                <td>{{$m->kode_brg}}</td>
                <td>{{$m->nama_brg}}</td>
                <td>{{$m->divisi->divisi}}</td>
                <td>{{$m->jenis->jenis}}</td>
                <td>{{$m->type->type}}</td>
                <td>{{$m->packing}}</td>
                <td>{{$m->quantity}}</td>
                <td>{{$m->hrg_jual}}</td>
                <td>{{$m->hrg_jual_total}}</td>
                <td>{{$m->gudang->nama}}</td>
                <td>{{$m->keterangan}}</td>
                <td><a class='btn btn-xs btn-info' href="{{route('master.edit',$m->kode_brg)}}">Update</a>
                <br><br><form method="POST" action="{{route('master.destroy',$m->kode_brg)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$m->kode_brg}} - {{$m->nama_brg}} ?');">
                  </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection