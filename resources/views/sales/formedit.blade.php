@extends('layout')

@section('title','Sales Edit Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Edit Sales Person</h3><br>

<form method="POST" action="{{route('salesPerson.update',$data->kode_sales)}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
   @method("PUT")
  <div class="form-group">
    <label for="exampleInputKodeSales">Kode Sales Person</label>
    <input type="text" name="kode_sales" class="form-control" id="kode_sales" value="{{$data->kode_sales}}" placeholder="Masukkan Kode Sales Person" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaSales">Nama Sales Person</label>
    <input type="text" name="nama_sales" class="form-control" id="nama_sales"  value="{{$data->nama_sales}}" placeholder="Masukkan Nama Sales Person" required>
  </div><br>
  <div class="form-group">
    <label for="select_divisi">Divisi</label>
    <select class="form-control" id="select_divisi" name="select_divisi">
        @foreach(['RETAIL','FOOD','COLDSTONE','SUBWAY'] as $option)
            <option value="{{$option}}" @if($option == $data->divisi) selected @endif>{{$option}}</option>
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