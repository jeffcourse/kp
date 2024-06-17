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
    #kodeBarangList {
      position: absolute;
      max-height: 200px;
      overflow-y: auto;
      z-index: 1000;
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

<div class="table-responsive">
<div class="barang-section" style="width: 1400px;">
   <table class="table">
    <thead>
      <tr>
        <th scope="col" style="display: none;">ID Barang</th>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Quantity Order</th>
        <th scope="col">Satuan</th>
        <th scope="col">Harga Per Unit</th>
        <th scope="col">Harga Total</th>
        <th scope="col">Gudang</th>
        <th scope="col">Hapus</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="display: none;">
          <div class="form-group">
            <input type="text" name="id_brg[]" id="id_brg" class="form-control" readonly>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input list="kodeBarangList" class="form-control" id="kode_barang_input" placeholder="Masukkan Kode Barang" autocomplete="off">
            <datalist id="kodeBarangList" style="overflow-y: hidden;">
            @foreach($master as $m)
              @if(!Str::contains($m->keterangan, ['BARANG RUSAK', 'BARANG EXPIRED', 'SALAH PENCATATAN']))
              <option value="{{$m->kode_brg}}">
              @endif
            @endforeach
            </datalist>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="text" name="nama_brg[]" id="nama_brg" class="form-control" required readonly>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="number" name="qty_order[]" id="qty_order" class="form-control qty_order" placeholder="Masukkan Quantity" required>
          </div>
        </td>
        <td>
          <div class="form-group">
            <select class="form-control" name="select_satuan[]" id="satuan" readonly>
              @foreach($satuan as $s)
              <option value="{{$s->id}}">{{$s->satuan}}</option>
              @endforeach
            </select>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="number" name="hrg_per_unit[]" id="hrg_per_unit" class="form-control hrg_per_unit" required readonly>
          </div>
        </td>
        <td>
          <div class="form-group">
            <input type="number" name="hrg_total[]" class="form-control hrg_total" placeholder="0" readonly>
          </div>
        </td>
        <td>
          <div class="form-group">
            <select class="form-control" name="select_gudang[]" id="gudang" style="width: 150px;" readonly>
              @foreach($gudang as $g)
              <option value="{{$g->kode}}">{{$g->nama}}</option>
              @endforeach
            </select>
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
</div>
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

        $('#kode_barang_input').attr('name', 'kode_brg[]');

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
          let gudangBrgArray = [];

          $('.barang-section table tbody tr').each(function(){
            let kodeBrg = $(this).find('input[name="kode_brg[]"]').val();
            let namaBrg = $(this).find('input[name="nama_brg[]"]').val();
            let gudangBrg = $(this).find('select[name="select_gudang[]"]').val();

            if((kodeBrgArray.includes(kodeBrg) && kodeGudangArray.includes(gudangBrg)) || (kodeBrgArray.includes(kodeBrg) && namaBrgArray.includes(namaBrg) && gudangBrgArray.includes(gudangBrg))){
                isDuplicate = true;
                return false;
            }

            kodeBrgArray.push(kodeBrg);
            namaBrgArray.push(namaBrg);
            gudangBrgArray.push(gudangBrg);
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

          barangBindings(newSection);

          $('.barang-section table tbody tr .btn-delete').prop('disabled', false);
          $('.barang-section table tbody tr:first .btn-delete').prop('disabled', true);
        });

        function calculateHargaTotal(section){
          var qty = $(section).find('.qty_order').val();
          var hrgPerUnit = parseFloat($(section).find('.hrg_per_unit').val());
          var hargaTotal = qty * hrgPerUnit;
          $(section).find('.hrg_total').val(hargaTotal.toFixed(2));
        }

        function calculateSubTotal(){
          var hargaSubTotal = 0;
          $('.barang-section table tbody tr').each(function (){
            var qty = $(this).find('.qty_order').val();
            var hrgPerUnit = parseFloat($(this).find('.hrg_per_unit').val());
            var hargaTotal = qty * hrgPerUnit;
            $(this).find('.hrg_total').val(hargaTotal.toFixed(2));
            hargaSubTotal += parseFloat(hargaTotal);
          });
          $('#sub_total').val(hargaSubTotal.toFixed(2));
        }

        function calculateTotal(){
          var subTotal = parseFloat($('#sub_total').val());
          var persenPpn = parseFloat($('#persen_ppn').val());
          var hargaTotal = subTotal + ((persenPpn / 100) * subTotal);
          $('#total').val(hargaTotal.toFixed(2));
        }

        $(document).on('input', '.qty_order, .hrg_per_unit', function (){
          calculateSubTotal();
          calculateTotal();
        });

        $('#persen_ppn').on('input', function (){
          calculateTotal();
        });

        calculateSubTotal();
        calculateTotal();

      $('form').submit(function(event){
        let isDuplicate = false;
        let kodeBrgArray = [];
        let namaBrgArray = [];
        let gudangBrgArray = [];

        $('.barang-section table tbody tr').each(function(){
            let kodeBrg = $(this).find('input[name="kode_brg[]"]').val();
            let namaBrg = $(this).find('input[name="nama_brg[]"]').val();
            let gudangBrg = $(this).find('select[name="select_gudang[]"]').val();

            if((kodeBrgArray.includes(kodeBrg) && kodeGudangArray.includes(gudangBrg)) || (kodeBrgArray.includes(kodeBrg) && namaBrgArray.includes(namaBrg) && gudangBrgArray.includes(gudangBrg))){
                isDuplicate = true;
                return false;
            }

            kodeBrgArray.push(kodeBrg);
            namaBrgArray.push(namaBrg);
            gudangBrgArray.push(gudangBrg);
        });

        if(isDuplicate){
            $('.error-message').text('Terdapat duplikasi kode, nama dan gudang barang');
            event.preventDefault();
        } else {
            $('.error-message').text('');
        }
      });

      $(document).on('click', '.btn-delete', function(){
        $(this).closest('tr').remove();
      });

      $('#kode_barang_input').on('focus', function(){
        $('#kodeBarangList').css('display', 'block');
      });

      function barangBindings(section){
        $('#kode_barang_input', section).on('input', function() {
          var kode_barang = $(this).val();
          var selectedMaster = {!! json_encode($master->toArray()) !!};
          var selectedGudang = {!! json_encode($gudang->toArray()) !!};
          var selectedSatuan = {!! json_encode($satuan->toArray()) !!};

          var masterData = selectedMaster.find(function(item) {
            return item.kode_brg == kode_barang;
          });

          if(masterData){
            var row = $('#kode_barang_input', section).closest('tr');
            row.find('input[name="id_brg[]"]').val(masterData.id);
            row.find('input[name="nama_brg[]"]').val(masterData.nama_brg);
            row.find('input[name="hrg_per_unit[]"]').val(masterData.hrg_jual);

            var masterQty = masterData.quantity;
            row.find('#qty_order').attr('max', masterQty);

            var filteredGudang = selectedGudang.filter(function(gudang){
                return gudang.kode == masterData.kode_gudang;
            });
            var filteredSatuan = selectedSatuan.filter(function(satuan){
                return satuan.id == masterData.id_satuan;
            });

            var gudangDropdown = row.find('select[name="select_gudang[]"]');
            gudangDropdown.empty();
            filteredGudang.forEach(function(gudang){
                gudangDropdown.append('<option value="' + gudang.kode + '">' + gudang.nama + '</option>');
            });

            var satuanDropdown = row.find('select[name="select_satuan[]"]');
            satuanDropdown.empty();
            filteredSatuan.forEach(function(satuan){
                satuanDropdown.append('<option value="' + satuan.id + '">' + satuan.satuan + '</option>');
            });
          } else{
            $(this).closest('tr').find('input[name="nama_brg[]"]').val('');
            $(this).closest('tr').find('input[name="hrg_per_unit[]"]').val('');
            $(this).closest('tr').find('select[name="select_gudang[]"]').empty();
            $(this).closest('tr').find('select[name="select_satuan[]"]').empty();
          }
        });
      }

      barangBindings($('.barang-section table tbody tr:first'));

      $(document).on('input', '.qty_order', function() {
        var masterQty = $(this).attr('max');
        var currentValue = $(this).val();
        if(parseInt(currentValue) > parseInt(masterQty)) {
          this.setCustomValidity('Kuantitas tidak boleh melebihi jumlah stok sebanyak ' + masterQty);
        } else {
          this.setCustomValidity('');
        }

        calculateSubTotal();
        calculateTotal();
      });
    });
</script>
@endsection