@extends('layout')

@section('title','Item Edit Page')
@section('content')
<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Edit Barang</h3><br>

<form method="POST" action="{{route('master.update',$data->kode_brg)}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
   @method("PUT")
  <div class="form-group">
    <label for="exampleInputKodeBarang">Kode Barang</label>
    <input type="text" name="kode_brg" class="form-control" id="kode_brg" value="{{$data->kode_brg}}" placeholder="Masukkan Kode Barang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaBarang">Nama Barang</label>
    <input type="text" name="nama_brg" class="form-control" id="nama_brg"  value="{{$data->nama_brg}}" placeholder="Masukkan Nama Barang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputDivisiBarang">Divisi</label>
    <select class="form-control" name="select_divisi" required>
        @foreach($divisi as $d)
        <option value="{{$d->kode}}" @if($d->kode == $data->kode_divisi) selected @endif>{{$d->divisi}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputJenisBarang">Jenis</label>
    <select class="form-control" name="select_jenis" required>
        @foreach($jenis as $j)
        <option value="{{$j->kode}}" @if($j->kode == $data->kode_jenis) selected @endif>{{$j->jenis}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputTipeBarang">Tipe</label>
    <select class="form-control" name="select_type" required>
        @foreach($type as $t)
        <option value="{{$t->kode}}" @if($t->kode == $data->kode_type) selected @endif>{{$t->type}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputPacking">Packing</label>
    <input type="text" name="packing" class="form-control packing" id="packing" value="{{$data->packing}}" placeholder="Masukkan Data Packing" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputQuantity">Quantity</label>
    <input type="number" name="quantity" class="form-control quantity" id="quantity" value="{{$data->quantity}}" placeholder="Masukkan Kuantitas Barang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputSatuanBarang">Satuan</label>
    <select class="form-control" name="select_satuan" required>
        @foreach($satuan as $s)
        <option value="{{$s->id}}" @if($s->id == $data->id_satuan) selected @endif>{{$s->satuan}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaJual">Harga Jual Per Item</label>
    <input type="number" name="hrg_jual_item" class="form-control hrg_jual_item" id="hrg_jual_item" value="{{$data->hrg_jual_item}}" placeholder="Masukkan Harga Jual Per Item" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaJual">Harga Jual Per Pack</label>
    <input type="number" name="hrg_jual" class="form-control hrg_jual" id="hrg_jual" value="{{$data->hrg_jual}}" placeholder="Masukkan Harga Jual Per Pack" readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaJualTotal">Harga Jual Total</label>
    <input type="number" name="hrg_jual_total" class="form-control" id="hrg_jual_total" value="{{$data->hrg_jual_total}}" placeholder="Masukkan Harga Jual Total" readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputGudangBarang">Gudang</label>
    <select class="form-control" name="select_gudang" required>
        @foreach($gudang as $g)
        <option value="{{$g->kode}}" @if($g->kode == $data->kode_gudang) selected @endif>{{$g->nama}}</option>
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
  $(document).ready(function (){
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
  });
</script>
@endsection