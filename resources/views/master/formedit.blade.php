@extends('layout')

@section('title','Item Edit Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Edit Barang</h3><br>

<form method="POST" action="{{route('master.update',$data->id)}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
   @method("PUT")
  <div class="form-group">
    <label for="exampleInputKodeBarang">Kode Barang</label>
    <input type="text" name="kode_brg" class="form-control" id="kode_brg" value="{{$data->kode_brg}}" placeholder="Masukkan Kode Barang" required readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaBarang">Nama Barang</label>
    <input type="text" name="nama_brg" class="form-control" id="nama_brg"  value="{{$data->nama_brg}}" placeholder="Masukkan Nama Barang" required readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputDivisiBarang">Divisi</label>
    <select class="form-control" name="select_divisi" required>
        <option value="" @if(is_null($data->kode_divisi)) selected @endif>-</option>
        @foreach($divisi as $d)
        <option value="{{$d->kode}}" @if($d->kode == $data->kode_divisi) selected @endif>{{$d->divisi}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputJenisBarang">Jenis</label>
    <select class="form-control" name="select_jenis" required>
        <option value="" @if(is_null($data->kode_jenis)) selected @endif>-</option>
        @foreach($jenis as $j)
        <option value="{{$j->kode}}" @if($j->kode == $data->kode_jenis) selected @endif>{{$j->jenis}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputTipeBarang">Tipe</label>
    <select class="form-control" name="select_type" required>
        <option value="" @if(is_null($data->kode_type)) selected @endif>-</option>
        @foreach($type as $t)
        <option value="{{$t->kode}}" @if($t->kode == $data->kode_type) selected @endif>{{$t->type}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputKeterangan">Keterangan</label>
    <input type="text" name="keterangan" class="form-control" id="keterangan" value="{{$data->keterangan}}" placeholder="Masukkan Keterangan" required>
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  /*$(document).ready(function (){
        function calculateHargaPack(){
            var packing = $('#packing').val();
            var packNum = parseInt(packing.split('x')[0]);
            var hrgPerItem = $('#hrg_jual_item').val();
            var hargaPack = packNum * hrgPerItem;
            $('#hrg_jual').val(hargaPack);
        }

        function calculateHargaTotal(){
            var qty = $('#quantity').val();
            var hrgPerPack = $('#hrg_jual').val();
            var hargaTotal = qty * hrgPerPack;
            $('#hrg_jual_total').val(hargaTotal);
        }

        calculateHargaPack();
        calculateHargaTotal();

        $(document).on('input', '.packing, .hrg_jual_item', function (){
            calculateHargaPack();
        });

        $(document).on('input', '.packing, .quantity, .hrg_jual_item', function (){
            calculateHargaTotal();
        });
  });*/
</script>
@endsection