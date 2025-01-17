@extends('layout')

@section('title','Gudang Edit Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Edit Gudang</h3><br>

<form method="POST" action="{{route('gudang.update',$data->kode)}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
   @method("PUT")
  <div class="form-group">
    <label for="exampleInputKode">Kode Gudang</label>
    <input type="text" name="kode" class="form-control" id="kode" value="{{$data->kode}}" placeholder="Masukkan Kode Gudang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNama">Nama Gudang</label>
    <input type="text" name="nama" class="form-control" id="nama"  value="{{$data->nama}}" placeholder="Masukkan Nama Gudang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputAlamat">Alamat Gudang</label>
    <input type="text" name="alamat" class="form-control" id="alamat"  value="{{$data->alamat}}" placeholder="Masukkan Alamat Gudang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKeterangan">Keterangan</label>
    <input type="text" name="keterangan" class="form-control" id="keterangan"  value="{{$data->keterangan}}" placeholder="Masukkan Keterangan" required>
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>
@endsection