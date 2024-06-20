@extends('layout')

@section('title','Add Item Page')
@section('content')
<div class="container"> <!-- Wrap the content in a container -->
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Supplier</h3><br>

<form method="POST" action="{{route('supplier.store')}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
  <div class="form-group">
    <label for="exampleInputKodeSupplier">Kode Supplier</label>
    <input type="text" name="kode_supp" class="form-control" id="kode_supp" placeholder="Masukkan Kode Supplier" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaBarang">Nama Supplier</label>
    <input type="text" name="nama_supp" class="form-control" id="nama_supp" placeholder="Masukkan Nama Supplier" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat1">Alamat</label>
    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Supplier" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputKontak">Nama Kontak</label>
    <input type="text" name="kontak" class="form-control" id="kontak" placeholder="Masukkan Nama Kontak" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputNoTelp">No Telp</label>
    <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="Masukkan No Telp" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputEmail">Email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required autocomplete="off">
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>
@endsection