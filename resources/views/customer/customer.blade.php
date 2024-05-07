@extends('layout')
@section('title','Customer')
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
    <h3 style="display: inline-block; margin-right: 20px;">Customer Table</h3>
    <a href="{{route('customer.create')}}" class="btn btn-success">Tambah Customer</a><br>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<table class="table" style="margin-left: 40px; margin-right: 80px;">
    <thead>
      <tr>
        <th>Kode Customer</th>
        <th>Nama Customer</th>
        <th>Tipe Customer</th>
        <th>Alamat 1</th>
        <th>Alamat 2</th>
        <th>Alamat 3</th>
        <th>Kota</th>
        <th>Kontak</th>
        <th>No Telp</th>
        <th>Saldo</th>
        <th>Nama Sales</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($customer as $c)
            <tr id="tr_{{$c->kode_cust}}">
                <td>{{$c->kode_cust}}</td>
                <td>{{$c->nama_cust}}</td>
                <td>{{$c->type_cust}}</td>
                <td>{{$c->alm_1}}</td>
                <td>{{$c->alm_2}}</td>
                <td>{{$c->alm_3}}</td>
                <td>{{$c->kota}}</td>
                <td>{{$c->kontak}}</td>
                <td>{{$c->no_telp}}</td>
                <td>{{$c->saldo}}</td>
                <td>{{$c->salesPerson->nama_sales}}</td>
                <td><a class='btn btn-xs btn-info' href="{{route('customer.edit',$c->kode_cust)}}">Update</a>
                <br><br><form method="POST" action="{{route('customer.destroy',$c->kode_cust)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$c->kode_cust}} - {{$c->nama_cust}} ?');">
                  </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection