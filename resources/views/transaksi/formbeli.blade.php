@extends('layout')

@section('title','Add Transaction Page')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Transaksi Pembelian</h3><br>

<form method="POST" action="{{route('beli.store')}}" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
  <div class="form-group">
    <label for="exampleInputNoBukti">Nomor Nota</label>
    <input type="text" name="no_bukti" class="form-control" id="no_bukti" placeholder="Masukkan Nomor Bukti" readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputTanggal">Tanggal</label>
    <input type="text" name="datepicker" id="datepicker" class="form-control" style="width: 200px; display: inline-block; margin-left: 10px;" placeholder="dd-mm-yyyy" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputSupplier">Supplier</label>
    <select class="form-control" name="select_supplier">
        @foreach($supplier as $s)
        <option value="{{$s->kode_supp}}">{{$s->nama_supp}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputMataUang">Mata Uang</label>
    <input type="text" name="mata_uang" class="form-control" id="mata_uang" placeholder="Masukkan Mata Uang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputGudang">Kirim Gudang</label>
    <select class="form-control" name="select_gudang">
        @foreach($gudang as $g)
        <option value="{{$g->kode}}">{{$g->nama}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaSubTotal">Harga Sub Total</label>
    <input type="number" name="sub_total" class="form-control" id="sub_total" placeholder="0" readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputPersenPpn">Persen PPN</label>
    <input type="number" name="persen_ppn" class="form-control" id="persen_ppn" placeholder="Masukkan Persentase PPN" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaTotal">Harga Total</label>
    <input type="number" name="total" class="form-control" id="total" placeholder="0" readonly>
  </div>

  <div class="barang-section"><br><br>
  <h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Barang 1</h3><br>
  <div class="form-group">
    <label for="exampleInputKodeBarang">Kode Barang</label>
    <input type="text" name="kode_brg[]" id="kode_brg" class="form-control" placeholder="Masukkan Kode Barang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputNamaBarang">Nama Barang</label>
    <input type="text" name="nama_brg[]" id="nama_brg" class="form-control" placeholder="Masukkan Nama Barang" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputQuantity">Quantity Order</label>
    <input type="number" name="qty_order[]" class="form-control qty_order" id="qty_order" placeholder="Masukkan Quantity Order" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputSatuan">Satuan</label>
    <select class="form-control" name="select_satuan[]">
        @foreach($satuan as $s)
        <option value="{{$s->id}}">{{$s->satuan}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaPerUnit">Harga Per Unit</label>
    <input type="number" name="hrg_per_unit[]" class="form-control hrg_per_unit" id="hrg_per_unit" placeholder="Masukkan Harga Per Unit" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaTotal">Harga Total</label>
    <input type="number" name="hrg_total[]" class="form-control hrg_total" id="hrg_total" placeholder="0" readonly>
  </div>
  </div><br><br>
  
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" id="btnTambah" class="btn btn-primary btn-block" style="width: 100%;">Tambah Barang 2</button>
    </div>
  </div><br>
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">Submit</button>
    </div>
  </div><br><br>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#datepicker", {
        dateFormat: "d-m-Y",
        defaultDate: "today"
  });

  const newNoBukti = "{{$newNoBukti}}";
  $(document).ready(function () {
        $('#no_bukti').val(newNoBukti);

        function calculateHargaTotal(section){
            var qty = $(section).find('.qty_order').val();
            var hrgPerUnit = $(section).find('.hrg_per_unit').val();
            var hargaTotal = qty * hrgPerUnit;
            $(section).find('.hrg_total').val(hargaTotal);
        }

        function calculateSubTotal(){
            var hargaSubTotal = 0;
            $('.hrg_total').each(function () {
                hargaSubTotal += parseFloat($(this).val());
            });
            $('#sub_total').val(hargaSubTotal);
        }

        function calculateTotal(){
            var subTotal = parseFloat($('#sub_total').val());
            var persenPpn = parseFloat($('#persen_ppn').val());
            var hargaTotal = subTotal + ((persenPpn / 100) * subTotal);
            $('#total').val(hargaTotal);
        }

        calculateHargaTotal('.barang-section');

        $(document).on('input', '.qty_order, .hrg_per_unit', function (){
            calculateHargaTotal($(this).closest('.barang-section'));
            calculateSubTotal();
            calculateTotal();
        });

        $('#persen_ppn').on('input', function (){
            calculateTotal();
        });

        let sectionCount = 1;
        let barangCount = 2;

        $('#btnTambah').click(function (){
            let isFilled = true;
            $('.barang-section:last input').each(function (){
                if ($(this).val() == ''){
                    isFilled = false;
                    return false;
                }
            });

            if(isFilled){
                sectionCount++;
                let newSection = $('.barang-section:last').clone();
                newSection.find('h3').text('Tambah Barang ' + sectionCount);
                $(this).text('Tambah Barang ' + (++barangCount));

                newSection.find('input').each(function (){
                    let name = $(this).attr('name');
                    $(this).attr('name', name.replace(/\d+$/, '') + sectionCount);
                    $(this).val('');
                });
                newSection.find('.qty_order, .hrg_per_unit, .hrg_total').val('');
                newSection.find('.hrg_total').attr('readonly', 'readonly');

                $('.barang-section:last').after(newSection);
            }
        });

        calculateSubTotal();
        calculateTotal();
    });
</script>
@endsection