@extends('layout')

@section('title','Add Transaction Page')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <style>
    .table {
      border: 2px solid #000000;
    }
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
      border: 2px solid black !important;
    }
    th{
        text-align: center;
    } 
  </style>
</head>

<div class="container">
<div class="mt-2"></div>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Transaksi Penjualan</h3><br>

<form method="POST" action="{{route('jual.store')}}">
<div class="container" style="margin-left: auto; margin-right: auto; width: 50%;">
   @csrf
  <div class="form-group">
    <label for="exampleInputNoBukti">Nomor Nota</label>
    <input type="text" name="no_bukti" class="form-control" id="no_bukti" placeholder="Masukkan Nomor Nota" readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputTanggal">Tanggal</label>
    <input type="text" name="datepicker" id="datepicker" class="form-control" style="width: 200px; display: inline-block; margin-left: 10px;" placeholder="dd-mm-yyyy" required>
  </div><br>
  <div class="form-group">
    <label for="exampleInputCustomer">Customer</label>
    <select class="form-control" name="select_customer">
        @foreach($customer as $c)
        <option value="{{$c->kode_cust}}">{{$c->nama_cust}}</option>
        @endforeach
    </select>
  </div><br>
  <div class="form-group">
    <label for="exampleInputHargaSubTotal">Harga Sub Total</label>
    <input type="number" name="sub_total" class="form-control" id="sub_total" placeholder="0" readonly>
  </div><br>
  <div class="form-group">
    <label for="exampleInputPersenPpn">Persen PPN (%)</label>
    <input type="number" name="persen_ppn" class="form-control" id="persen_ppn" placeholder="Masukkan Nilai PPN" required>
  </div><label for="exampleInputPersen" style="fontSize: 10px;">Contoh input: 10</label><br><br>
  <div class="form-group">
    <label for="exampleInputHargaTotal">Harga Total</label>
    <input type="number" name="total" class="form-control" id="total" placeholder="0" readonly>
  </div>
</div>

<br><br>
<h3 style="margin-left: auto; margin-right: auto; text-align: center;">Tambah Barang</h3><br>

<div class="barang-section" style="width: 100%;">
   <table class="table">
    <thead>
      <tr>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Quantity Order</th>
        <th scope="col">Satuan</th>
        <th scope="col">Harga Per Unit</th>
        <th scope="col">Harga Total</th>
        <th scope="col">Hapus</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <div class="form-group">
            <input type="text" name="kode_brg[]" class="form-control" placeholder="Masukkan Kode Barang" required>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="text" name="nama_brg[]" class="form-control" placeholder="Masukkan Nama Barang" required>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="number" name="qty_order[]" class="form-control qty_order" placeholder="Masukkan Quantity" required>
          </div>
        </td>
        <td>
          <div class="form-group">
            <select class="form-control" name="select_satuan[]">
              @foreach($satuan as $s)
              <option value="{{$s->id}}">{{$s->satuan}}</option>
              @endforeach
            </select>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="number" name="hrg_per_unit[]" class="form-control hrg_per_unit" placeholder="Masukkan Harga" required>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="number" name="hrg_total[]" class="form-control hrg_total" placeholder="0" readonly>
          </div>
        </td>
        <td>
          <div class="form-group">
            <button type="button" class="btn btn-danger btn-delete">Delete</button>
          </div>
        </td>
      </tr>
    </tbody>
   </table>
</div><br>
<div class="error-message" style="color: red; text-align: center;"></div>
<br>
  <div class="form-group row" style="text-align: center;">
    <div class="col-12">
      <button type="submit" id="btnTambah" class="btn btn-primary btn-block" style="width: 50%;">Tambah Barang</button>
    </div>
  </div><br>
  <div class="form-group row" style="text-align: center;">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block" style="width: 50%;">Submit</button>
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
  $(document).ready(function (){
        $('#no_bukti').val(newNoBukti);

        $('.barang-section table tbody tr:first .btn-delete').prop('disabled', true);

        $('#btnTambah').click(function (){
          let lastRow = $('.barang-section table tbody tr:last');
          let isFilled = true;

          lastRow.find('input').each(function (){
            if ($(this).val() === '') {
              isFilled = false;
              return false;
            }
          });

          if (!isFilled){
            return; 
          }

          //Check for duplicate kode_brg and nama_brg
          let isDuplicate = false;
          let kodeBrgArray = [];
          let namaBrgArray = [];

          $('.barang-section table tbody tr').each(function() {
            let kodeBrg = $(this).find('input[name="kode_brg[]"]').val();
            let namaBrg = $(this).find('input[name="nama_brg[]"]').val();

            if((kodeBrgArray.includes(kodeBrg)) || (kodeBrgArray.includes(kodeBrg) && namaBrgArray.includes(namaBrg))){
                isDuplicate = true;
                return false;
            }

            kodeBrgArray.push(kodeBrg);
            namaBrgArray.push(namaBrg);
          });

          if(isDuplicate){
            $('.error-message').text('Terdapat duplikasi kode barang dan nama barang');
            return;
          } else {
            $('.error-message').text('');
          }

          let newSection = lastRow.clone();
          newSection.find('input').val('');
          newSection.find('.hrg_total').val('0');
          newSection.find('.hrg_total').attr('readonly', 'readonly');
          $('.barang-section table tbody').append(newSection);

          $('.barang-section table tbody tr .btn-delete').prop('disabled', false);
          $('.barang-section table tbody tr:first .btn-delete').prop('disabled', true);
        });

        function calculateHargaTotal(section) {
          var qty = $(section).find('.qty_order').val();
          var hrgPerUnit = $(section).find('.hrg_per_unit').val();
          var hargaTotal = qty * hrgPerUnit;
          $(section).find('.hrg_total').val(hargaTotal);
        }

        function calculateSubTotal() {
          var hargaSubTotal = 0;
          $('.barang-section table tbody tr').each(function () {
            var qty = $(this).find('.qty_order').val();
            var hrgPerUnit = $(this).find('.hrg_per_unit').val();
            var hargaTotal = qty * hrgPerUnit;
            $(this).find('.hrg_total').val(hargaTotal);
            hargaSubTotal += parseFloat(hargaTotal);
          });
          $('#sub_total').val(hargaSubTotal);
        }

        function calculateTotal() {
          var subTotal = parseFloat($('#sub_total').val());
          var persenPpn = parseFloat($('#persen_ppn').val());
          var hargaTotal = subTotal + ((persenPpn / 100) * subTotal);
          $('#total').val(hargaTotal);
        }

        $(document).on('input', '.qty_order, .hrg_per_unit', function () {
          calculateSubTotal();
          calculateTotal();
        });

        $('#persen_ppn').on('input', function () {
          calculateTotal();
        });

        calculateSubTotal();
        calculateTotal();

      $('form').submit(function(event) {
        let isDuplicate = false;
        let kodeBrgArray = [];
        let namaBrgArray = [];

        $('.barang-section table tbody tr').each(function() {
            let kodeBrg = $(this).find('input[name="kode_brg[]"]').val();
            let namaBrg = $(this).find('input[name="nama_brg[]"]').val();

            if((kodeBrgArray.includes(kodeBrg)) || (kodeBrgArray.includes(kodeBrg) && namaBrgArray.includes(namaBrg))){
                isDuplicate = true;
                return false;
            }

            kodeBrgArray.push(kodeBrg);
            namaBrgArray.push(namaBrg);
        });

        if(isDuplicate){
            $('.error-message').text('Terdapat duplikasi kode barang dan nama barang');
            event.preventDefault();
        } else {
            $('.error-message').text('');
        }
      });

      $(document).on('click', '.btn-delete', function(){
        $(this).closest('tr').remove();
      });
    });
</script>
@endsection