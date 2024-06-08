@extends('layout')

@section('title','Add Sales Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Sales Person</h3><br>

<form method="POST" action="{{route('salesPerson.store')}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
  <div class="form-group">
    <label for="exampleInputKodeSales">Kode Sales Person</label>
    <input type="text" name="kode_sales" class="form-control" id="kode_sales" placeholder="Masukkan Kode Sales Person" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaSales">Nama Sales Person</label>
    <input type="text" name="nama_sales" class="form-control" id="nama_sales" placeholder="Masukkan Nama Sales Person" required autocomplete="off">
  </div><br>
  <div class="form-group">
    <label for="select_divisi">Divisi</label>
    <select class="form-control" id="select_divisi" name="select_divisi">
        @foreach(['RETAIL','FOOD','COLDSTONE','SUBWAY'] as $option)
            <option value="{{$option}}">{{$option}}</option>
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