@extends('layout')

@section('title','Edit Item Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Edit Customer</h3><br>

<form method="POST" action="{{route('customer.update',$data->kode_cust)}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
   @method("PUT")
  <div class="form-group">
    <label for="exampleInputKodeCustomer">Kode Customer</label>
    <input type="text" name="kode_cust" class="form-control" id="kode_cust" value="{{$data->kode_cust}}" placeholder="Masukkan Kode Customer" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaCustomer">Nama Customer</label>
    <input type="text" name="nama_cust" class="form-control" id="nama_cust" value="{{$data->nama_cust}}" placeholder="Masukkan Nama Customer" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputTipeCustomer">Tipe Customer</label>
    <input type="text" name="type_cust" class="form-control" id="type_cust" value="{{$data->type_cust}}" placeholder="Masukkan Tipe Customer" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat1">Alamat 1</label>
    <input type="text" name="alm_1" class="form-control" id="alm_1" value="{{$data->alm_1}}" placeholder="Masukkan Alamat Customer" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat2">Alamat 2</label>
    <input type="text" name="alm_2" class="form-control" id="alm_2" value="{{$data->alm_2}}" placeholder="Masukkan Alamat Customer" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat3">Alamat 3</label>
    <input type="text" name="alm_3" class="form-control" id="alm_3" value="{{$data->alm_3}}" placeholder="Masukkan Alamat Customer" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKota">Kota</label>
    <input type="text" name="kota" class="form-control" id="kota" value="{{$data->kota}}" placeholder="Masukkan Kota" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKontak">Kontak Customer</label>
    <input type="text" name="kontak" class="form-control" id="kontak" value="{{$data->kontak}}" placeholder="Masukkan Nama Kontak" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNoTelp">No Telp</label>
    <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{$data->no_telp}}" placeholder="Masukkan No Telp" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaSales">Nama Sales</label>
    <select class="form-control" name="select_sales">
        @foreach($salesPerson as $s)
        <option value="{{$s->kode_sales}}" @if($s->kode_sales == $data->kode_sales) selected @endif>{{$s->nama_sales}}</option>
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