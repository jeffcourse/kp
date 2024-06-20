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
    <label for="exampleInputAlamat1">Alamat 1</label>
    <input type="text" name="alamat" class="form-control" id="alamat" value="{{$data->alamat}}" placeholder="Masukkan Alamat Customer" required>
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
    <select class="form-control" name="select_sales" required>
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