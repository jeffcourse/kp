@extends('layout')

@section('title','Add Item Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Customer</h3><br>

<form method="POST" action="{{route('customer.store')}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
  <div class="form-group">
    <label for="exampleInputKodeCustomer">Kode Customer</label>
    <input type="text" name="kode_cust" class="form-control" id="kode_cust" placeholder="Masukkan Kode Customer" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaCustomer">Nama Customer</label>
    <input type="text" name="nama_cust" class="form-control" id="nama_cust" placeholder="Masukkan Nama Customer" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat1">Alamat</label>
    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Customer" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputKontak">Kontak Customer</label>
    <input type="text" name="kontak" class="form-control" id="kontak" placeholder="Masukkan Nama Kontak" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputNoTelp">No Telp</label>
    <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="Masukkan No Telp" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaSales">Nama Sales</label>
    <select class="form-control" name="select_sales">
        @foreach($salesPerson as $s)
        <option value="{{$s->kode_sales}}">{{$s->nama_sales}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>
@endsection