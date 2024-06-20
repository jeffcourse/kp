@extends('layout')
@section('title','Inventory')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .table {
      border: 2px solid #000000;
    }
    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
      border: 2px solid black !important;
    }
    th{
        text-align: center;
    } 
  </style>
</head>

<div class="mt-5">
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center">
      <h4 style="display: inline-block; margin-right: 20px;">Inventory Table</h4>
      {{--<a style="margin-right: 20px;" href="{{route('master.create')}}" class="btn btn-info">Tambah Barang</a>--}}
    </div>
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
      <h4 style="display: inline-block;">Filter berdasarkan gudang:</h4>
      <select id="filterGudang" class="form-control" style="width: 200px; display: inline-block;">
        <option value="All">All</option>
          @foreach($gudang as $gd)
            <option value="{{$gd->nama}}">{{$gd->nama}}</option>
          @endforeach
      </select>
    </div>
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
      <h4 style="display: inline-block;">Filter berdasarkan jenis:</h4>
      <select id="filterJenis" class="form-control" style="width: 200px; display: inline-block;">
        <option value="All">All</option>
          @foreach($jenis as $jn)
            <option value="{{$jn->jenis}}">{{$jn->jenis}}</option>
          @endforeach
      </select>
    </div>
</div>
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
        <input style="width: 200px; display: inline-block;" type="text" id="searchItem" class="form-control" placeholder="Cari kode/nama barang" autocomplete="off">
    </div>
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
        <input type="text" id="datepicker" class="form-control" style="width: 150px; display: inline-block;" placeholder="dd-mm-yyyy">
        <form id="pdfForm" action="{{route('OpnamePdf')}}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="selectedGudang" id="selectedGudang" value="">
            <input type="hidden" name="selectedTanggal" id="selectedTanggal" value="">
        </form>
        <a class='btn btn-info' id="unduhPdf" style="margin-left: 10px;" href="javascript:void(0)">Lihat Laporan Stok Opname Sesuai Filter</a>
    </div>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Divisi</th>
        <th>Jenis Barang</th>
        <th>Tipe Barang</th>
        <th>Quantity</th>
        <th>Satuan</th>
        <th>Harga Jual</th>
        <th class="gudang-th">Gudang</th>
        <th>Keterangan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($master as $m)
            <tr id="tr_{{$m->id}}">
                <td>{{$m->kode_brg}}</td>
                <td>{{$m->nama_brg}}</td>
                <td>{{$m->divisi ? $m->divisi->divisi : '-'}}</td>
                <td>{{$m->jenis ? $m->jenis->jenis : '-'}}</td>
                <td>{{$m->type ? $m->type->type : '-'}}</td>
                <td>{{$m->quantity}}</td>
                <td>{{$m->satuan->satuan}}</td>
                <td>Rp. {{number_format(floatval($m->hrg_jual), 2, ',', '.')}}</td>
                @if($selectedGudang != 'All')
                  <td>{{$m->gudang->nama}}</td>
                @endif
                <td>{{$m->keterangan}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Action">
                    @if($selectedGudang == 'All')
                    <a class='btn btn-info' href="{{route('master.edit',['kode_brg' => $m->kode_brg, 'nama_brg' => $m->nama_brg])}}">Edit</a>
                    @endif
                    @if($selectedGudang != 'All')
                      <button class='btn btn-danger btn-opname' 
                        data-toggle="modal" 
                        data-kode="{{$m->kode_brg}}"
                        data-nama="{{$m->nama_brg}}"
                        data-quantity="{{$m->quantity}}"
                        data-satuan="{{$m->id_satuan}}"
                        data-gudang="{{$m->kode_gudang}}"
                        data-toggle="modal" 
                        data-target="#opnameModal">Opname</button>
                    @endif
                    {{--<form method="POST" action="{{route('master.destroy', $m->id)}}">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$m->kode_brg}} - {{$m->nama_brg}} ?');">Delete</button>
                    </form>--}}
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if($master->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($master->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$master->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $master->lastPage(); $i++)
            @if($i >= $master->currentPage() - 2 && $i <= $master->currentPage() + 2)
                @if($i == $master->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$master->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($master->hasMorePages())
            <li><a href="{{$master->nextPageUrl()}}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    @endif
  </div><br><br>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  $(document).ready(function(){
    flatpickr("#datepicker", {
        dateFormat: "d-m-Y",
    });

    function initFilterHide() {
      var selectedGudang = $('#filterGudang').val();
      if (selectedGudang == 'All'){
        $('.gudang-th').hide();
      } else{
        $('.gudang-th').show();
      }
    }

    initFilterHide();

    $('#filterGudang').change(function () {
      var selectedGudang = $(this).val();
      if (selectedGudang == 'All') {
        $('.gudang-th').hide();
      } else {
        $('.gudang-th').show();
      }
    });

    function loadFilters(){
        var filterGudangValue = sessionStorage.getItem('filterGudang');
        var filterJenisValue = sessionStorage.getItem('filterJenis');
        var searchItemValue = sessionStorage.getItem('searchItem');
        if (filterGudangValue) {
            $('#filterGudang').val(filterGudangValue);
            $('#filterGudang').trigger('change');
        }
        if (filterJenisValue) {
            $('#filterJenis').val(filterJenisValue);
        }
        if (searchItemValue) {
            $('#searchItem').val(searchItemValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var selectedGudang = $('#filterGudang').val();
        var selectedJenis = $('#filterJenis').val();
        var searchText = $('#searchItem').val();

        sessionStorage.setItem('filterGudang', selectedGudang);
        sessionStorage.setItem('filterJenis', selectedJenis);
        sessionStorage.setItem('searchItem', searchText);
    }

    function updateTableData(page){
        var selectedGudang = $('#filterGudang').val();
        var selectedJenis = $('#filterJenis').val();
        var searchText = $('#searchItem').val();

        $.ajax({
            url: "{{route('master')}}",
            type: "GET",
            data: {gudang: selectedGudang, jenis: selectedJenis, search: searchText, page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $('#filterGudang, #filterJenis, #searchItem').on('change keyup', function(){
        saveFilters();
        updateTableData(1);
    });

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);

    function calculateSelisih(){
      var qtyFisik = $('#qty_fisik').val();
      var qtySistem = $('#qty_sistem').val();
      var selisih = qtyFisik - qtySistem;
      $('#selisih').val(selisih);
      return selisih;
    }

    function calculateQtyOrder(){
      var trans = $('input[name="transaksi"]:checked').val();
      var selisih = parseInt($('#selisih').val());
      var qtyOrder = parseInt($('#qty-order').val());
      if(trans == "pembelian"){
        var qtyOrder = qtyOrder + selisih;
      }else{
        var qtyOrder = qtyOrder - selisih;
      }
      $('#qty-order').val(qtyOrder);
      calculateHargaTotal();
      return qtyOrder;
    }

    function calculateHargaTotal(){
      var qtyOrder = $('#qty-order').val();
      var hrgPerUnit = $('#hrg-per-unit').val();
      var hrgTotal = qtyOrder * hrgPerUnit;
      $('#hrg-total').val(hrgTotal);
      return hrgTotal;
    }

    $('#qty_fisik').on('input', function(){
      calculateSelisih();
      calculateQtyOrder();

      var noBukti = $('#no-bukti').val();
      fetchTransactionData(noBukti);
    });

    $('#selisih').on('input', function(){
        calculateQtyOrder();
    });

    $('#qty-order').on('input', function(){
        calculateHargaTotal();
    });

    $(document).on('click', '.btn-opname', function(e) {
      e.preventDefault();
      var kodeBrg = $(this).data('kode');
      var namaBrg = $(this).data('nama');
      var quantityBrg = $(this).data('quantity');
      var satuanBrg = $(this).data('satuan');
      var gudangBrg = $(this).data('gudang');

      $('#kode-barang').val(kodeBrg);
      $('#nama-barang').val(namaBrg);
      $('#kode-gudang').val(gudangBrg);
      $('#qty_sistem').val(quantityBrg);
      $('#opnameModal').modal('show');

      $('#simpanOpname').click(function() {
        var quantity = $('#qty_sistem').val();
        var qtyFisik = $('#qty_fisik').val();
        var selisih = $('#selisih').val();
        var keterangan = $('#keterangan').val();
        var transaction = $('input[name="transaksi"]:checked').val();
        var noBukti = $('#no-bukti').val();
        var qtyOrder = $('#qty-order').val();
        var hrgTotal = $('#hrg-total').val();

        $.ajax({
          url: "{{route('OpnameBarang')}}",
          type: 'GET',
          data: {kode_brg: kodeBrg, nama_brg: namaBrg, quantity: selisih, qty_awal: quantity, qty_fisik: qtyFisik, id_satuan: satuanBrg, 
            kode_gudang: gudangBrg, keterangan: keterangan, transaction: transaction, no_bukti: noBukti, qty_order: qtyOrder, hrg_total: hrgTotal},
          success: function(response) {
            $('#opnameModal').modal('hide');

            $('#kode-barang').val('');
            $('#nama-barang').val('');
            $('#qty_sistem').val('');
            $('#qty_fisik').val('');
            $('#selisih').val('');
            $('.modal-backdrop').remove();
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
        $('#opnameModal').modal('hide');
      });
    });

    $('#opnameModal').on('hidden.bs.modal', function (e) {
      location.reload();
    });

    $('#keterangan').change(function() {
      var selectedValue = $(this).val();
      if (selectedValue === 'SALAH PENCATATAN') {
        $('#revisiTransaksi').show();
        fetchTransaction('pembelian');
      } else {
        $('#revisiTransaksi').hide();
      }
    });

    $(document).on('change', 'input[type="radio"][name="transaksi"]', function() {
      var selectedValue = $(this).val();
      fetchTransaction(selectedValue);
    });

    function fetchTransaction(selectedValue) {
      var kodeBrg = $('#kode-barang').val();
      var namaBrg = $('#nama-barang').val();
      var gudangBrg = $('#kode-gudang').val();

      $.ajax({
        url: "{{route('FetchNoBukti')}}",
        type: "GET",
        data: {selectedValue: selectedValue, kodeBrg: kodeBrg, namaBrg: namaBrg, gudangBrg: gudangBrg},
        success: function(response) {
          var optionsHtml = '';
          if(response.length > 0) {
            $('#no-bukti').empty();
            $('#trans-content').show();
            response.forEach(function(item) {
              optionsHtml += '<option value="' + item.no_bukti + '">' + item.no_bukti + '</option>';
            });
          }else {
            optionsHtml = '<option value="">No data available</option>';
            $('#trans-content').hide();
          }
          $('#no-bukti').empty().append(optionsHtml);

          var firstOption = response.length > 0 ? response[0].no_bukti : null;
          fetchTransactionData(firstOption);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          $('#no-bukti').html('<option value="">Error fetching data</option>');
          $('#trans-content').hide();
        }
      });
    }

    $('#no-bukti').change(function() {
      var noBukti = $(this).val();
      fetchTransactionData(noBukti);
      
      if(noBukti == "No data available"){
        $('#qty-order').prop('disabled', true);
        $('#trans-content').hide();
      }
    });

    function fetchTransactionData(noBukti){
      var transaction = $('input[name="transaksi"]:checked').val();
      var kodeBrg = $('#kode-barang').val();
      var namaBrg = $('#nama-barang').val();
      var gudangBrg = $('#kode-gudang').val();
      var selisih = $('#selisih').val();

      $.ajax({
        url: "{{route('FetchTransData')}}",
        type: "GET",
        data: {transaction: transaction, noBukti: noBukti, kodeBrg: kodeBrg, namaBrg: namaBrg, gudangBrg: gudangBrg},
        success: function(response) {
          response.forEach(function(item) {
            $('#kode-barang-trans').val(item.kode_brg);
            $('#nama-barang-trans').val(item.nama_brg);
            $('#qty-order').val(item.qty_order);
            var qtyOrder = parseInt(item.qty_order);
            var newQtyOrder = transaction == 'pembelian' ? qtyOrder + parseInt(selisih) : qtyOrder - parseInt(selisih);

            $('#qty-order').val(newQtyOrder);
            $('#hrg-per-unit').val(item.hrg_per_unit);

            var hrgPerUnit = parseFloat(item.hrg_per_unit);
            var newHrgTotal = newQtyOrder * hrgPerUnit; 
            $('#hrg-total').val(newHrgTotal);
            $('#kode-gudang-trans').val(item.kode_gudang);
          });
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }

    $("#unduhPdf").click(function(){
        var gudangBarang = $('#filterGudang').val();
        var tanggal = $('#datepicker').val();
        $('#selectedGudang').val(gudangBarang);
        $('#selectedTanggal').val(tanggal);
        $('#pdfForm').submit();
    });
  });
</script>

<div class="modal fade" id="opnameModal" tabindex="-1" role="dialog" aria-labelledby="opnameModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="opnameModalLabel">Opname Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Kode Barang:</h5>
        <input type="text" id="kode-barang" class="form-control" readonly><br>
        <h5>Nama Barang:</h5>
        <input type="text" id="nama-barang" class="form-control" readonly><br>
        <input style="display: none;" id="kode-gudang" class="form-control">
        <h5>Kuantitas Barang Sistem:</h5>
        <input type="number" id="qty_sistem" class="form-control" readonly><br>
        <h5>Kuantitas Barang Fisik (Barang Baik):</h5>
        <input type="number" id="qty_fisik" class="form-control" required><br>
        <h5>Selisih:</h5>
        <input type="number" id="selisih" name="selisih" class="form-control" readonly><br>
        <h5>Keterangan:</h5>
        <select id="keterangan" class="form-control" style="width: 400px; display: inline-block;">
          <option value="BARANG RUSAK">BARANG RUSAK</option>
          <option value="BARANG EXPIRED">BARANG EXPIRED</option>
          <option value="SALAH PENCATATAN">SALAH PENCATATAN</option>
        </select><br><br>

        <div id="revisiTransaksi" style="display: none;">
          <h5 id="revisiTransaksiLabel">Pilih Transaksi Terkait Untuk Koreksi Otomatis</h5>
          <div id="radioButtonsContainer">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transaksi" id="radioPembelian" value="pembelian" checked>
              <label class="form-check-label" for="radioPembelian">Pembelian</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="transaksi" id="radioPenjualan" value="penjualan">
              <label class="form-check-label" for="radioPenjualan">Penjualan</label>
            </div>
          </div><br>
          <h5>Nomor Nota:</h5>
          <select id="no-bukti" class="form-control" style="width: 400px; display: inline-block;"></select><br><br>
          <div id="trans-content">
            <h5 id="kode-barang-trans-label">Kode Barang:</h5>
            <input type="text" id="kode-barang-trans" class="form-control" readonly><br>
            <h5 id="nama-barang-trans-label">Nama Barang:</h5>
            <input type="text" id="nama-barang-trans" class="form-control" readonly><br>
            <h5 id="qty-order-label">Quantity Order:</h5>
            <input type="number" id="qty-order" class="form-control" readonly><br>
            <h5 id="hrg-per-unit-label">Harga Per Unit:</h5>
            <input type="number" id="hrg-per-unit" class="form-control" readonly><br>
            <h5 id="hrg-total-label">Harga Total:</h5>
            <input type="number" id="hrg-total" class="form-control" readonly><br>
            <input style="display: none;" type="text" id="kode-gudang-trans" class="form-control">
          </div> 
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpanOpname">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endsection