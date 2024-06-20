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
    <label for="exampleInputAlamat1">Alamat</label>
    <input type="text" name="alamat" class="form-control" id="alamat" value="{{$data->alamat}}" placeholder="Masukkan Alamat Supplier" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKontak">Nama Kontak</label>
    <input type="text" name="kontak" class="form-control" id="kontak" value="{{$data->kontak}}" placeholder="Masukkan Nama Kontak" required>
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