@extends('layout')

@section('title','Item Edit Page')
@section('content')
<div class="container"> <!-- Wrap the content in a container -->
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Edit Supplier</h3><br>

<form method="POST" action="{{route('supplier.update',$data->kode_supp)}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
   @method("PUT")
  <div class="form-group">
    <label for="exampleInputKodeSupplier">Kode Supplier</label>
    <input type="text" name="kode_supp" class="form-control" id="kode_supp" value="{{$data->kode_supp}}" placeholder="Masukkan Kode Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaBarang">Nama Supplier</label>
    <input type="text" name="nama_supp" class="form-control" id="nama_supp"  value="{{$data->nama_supp}}" placeholder="Masukkan Nama Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAkunBank">Akun Bank</label>
    <input type="text" name="acc_bank" class="form-control" id="acc_bank" value="{{$data->acc_bank}}" placeholder="Masukkan Akun Bank" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat1">Alamat 1</label>
    <input type="text" name="alm_1" class="form-control" id="alm_1" value="{{$data->alm_1}}" placeholder="Masukkan Alamat Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat2">Alamat 2</label>
    <input type="text" name="alm_2" class="form-control" id="alm_2" value="{{$data->alm_2}}" placeholder="Masukkan Alamat Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKota">Kota</label>
    <input type="text" name="kota" class="form-control" id="kota" value="{{$data->kota}}" placeholder="Masukkan Kota" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNegara">Negara</label>
    <input type="text" name="negara" class="form-control" id="negara" value="{{$data->negara}}" placeholder="Masukkan Negara" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKontak">Nama Kontak</label>
    <input type="text" name="kontak" class="form-control" id="kontak" value="{{$data->kontak}}" placeholder="Masukkan Nama Kontak" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputJabatan">Jabatan Kontak</label>
    <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{$data->jabatan}}" placeholder="Masukkan Jabatan Kontak" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNoTelp">No Telp</label>
    <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{$data->no_telp}}" placeholder="Masukkan No Telp" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputEmail">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="{{$data->email}}" placeholder="Masukkan Email" required>
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>
@endsection