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
    <input type="text" name="kode_supp" class="form-control" id="kode_supp" placeholder="Masukkan Kode Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaBarang">Nama Supplier</label>
    <input type="text" name="nama_supp" class="form-control" id="nama_supp" placeholder="Masukkan Nama Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAkunBank">Akun Bank</label>
    <input type="text" name="acc_bank" class="form-control" id="acc_bank" placeholder="Masukkan Akun Bank" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat1">Alamat 1</label>
    <input type="text" name="alm_1" class="form-control" id="alm_1" placeholder="Masukkan Alamat Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat2">Alamat 2</label>
    <input type="text" name="alm_2" class="form-control" id="alm_2" placeholder="Masukkan Alamat Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKota">Kota</label>
    <input type="text" name="kota" class="form-control" id="kota" placeholder="Masukkan Kota" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNegara">Negara</label>
    <input type="text" name="negara" class="form-control" id="negara" placeholder="Masukkan Negara" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKontak">Nama Kontak</label>
    <input type="text" name="kontak" class="form-control" id="kontak" placeholder="Masukkan Nama Kontak" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputJabatan">Jabatan Kontak</label>
    <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Masukkan Jabatan Kontak" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNoTelp">No Telp</label>
    <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="Masukkan No Telp" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputEmail">Email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputSaldo">Saldo</label>
    <input type="number" name="saldo" class="form-control" id="saldo" placeholder="Masukkan Saldo" required>
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>
@endsection