@extends('layout')
@section('title','Kartu Stok')
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
      <h4 style="display: inline-block; margin-right: 20px;">Kartu Stok</h4>
    </div>
</div>
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
      <h4 style="display: inline-block;">Filter berdasarkan gudang:</h4>
      <select id="filterGudang" class="form-control" style="width: 200px; display: inline-block;">
        <option value="All">All</option>
          @foreach($gudang as $gd)
            <option value="{{$gd->kode}}">{{$gd->nama}}</option>
          @endforeach
      </select>
    </div>
    <input style="width: 230px; display: inline-block;" type="text" id="searchItem" class="form-control" placeholder="Cari kode/nama barang" autocomplete="off">
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
      <h4 style="display: inline-block; margin-left: 10px;">Filter transaksi:</h4>
      <select id="filterTransaksi" class="form-control" style="width: 200px; display: inline-block;">
        <option value="All">All</option>
        <option value="BL">Pembelian</option>
        <option value="JL">Penjualan</option>
        <option value="-">Rusak/EXP</option>
      </select>
    </div>
</div><br>
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
        <input type="text" id="datepicker" class="form-control" style="width: 150px; display: inline-block;" placeholder="dd-mm-yyyy">
        <h4>-</h4>
        <input type="text" id="datepicker2" class="form-control" style="width: 150px; display: inline-block;" placeholder="dd-mm-yyyy">
        <button id="allDates" class="btn btn-primary" style="margin-left: 10px;">All Dates</button>
      </div>
      <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
        <form id="pdfForm" action="{{route('KartuPdf')}}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="selectedGudang" id="selectedGudang" value="">
            <input type="hidden" name="searchText" id="searchText" value="">
            <input type="hidden" name="selectedTrans" id="selectedTrans" value="">
            <input type="hidden" name="tglAwal" id="tglAwal" value="">
            <input type="hidden" name="tglAkhir" id="tglAkhir" value="">
        </form>
        <a class='btn btn-info' id="unduhPdf" style="margin-left: 10px;" href="javascript:void(0)">Unduh Kartu Stok Sesuai Filter</a>
    </div>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th>Gudang</th>
        <th>Nomor Nota</th>
        <th>Tanggal Mutasi</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Stok Awal</th>
        <th>Masuk</th>
        <th>Keluar</th>
        <th>Rusak/EXP</th>
        <th>Stok Akhir</th>
      </tr>
    </thead>
    <tbody>
        @foreach($kartuStok as $k)
            <tr id="tr_{{$k->id}}">
                <td>{{$k->gudang->nama}}</td>
                <td>{{$k->no_bukti}}</td>
                <td>{{date('d-m-Y', strtotime($k->tanggal))}}</td>
                <td>{{$k->kode_brg}}</td>
                <td>{{$k->nama_brg}}</td>
                <td>{{$k->satuan->satuan}}</td>
                <td>{{$k->stok_awal}}</td>
                <td>{{$k->qty_masuk}}</td>
                <td>{{$k->qty_keluar}}</td>
                <td>{{$k->qty_rusak_exp}}</td>
                <td>{{$k->stok_akhir}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if($kartuStok->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($kartuStok->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$kartuStok->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $kartuStok->lastPage(); $i++)
            @if($i >= $kartuStok->currentPage() - 2 && $i <= $kartuStok->currentPage() + 2)
                @if($i == $kartuStok->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$kartuStok->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($kartuStok->hasMorePages())
            <li><a href="{{$kartuStok->nextPageUrl()}}" rel="next">&raquo;</a></li>
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

    flatpickr("#datepicker2", {
        dateFormat: "d-m-Y",
    });

    function loadFilters(){
        var filterGudangValue = sessionStorage.getItem('filterGudangKartu');
        var searchItemValue = sessionStorage.getItem('searchItemKartu');
        var filterTransValue = sessionStorage.getItem('filterTrans');
        var tglAwalValue =  sessionStorage.getItem('tglAwal');
        var tglAkhirValue = sessionStorage.getItem('tglAkhir');
        if(filterGudangValue){
            $('#filterGudang').val(filterGudangValue);
            $('#selectedGudang').val(filterGudangValue);
        }
        if(searchItemValue){
            $('#searchItem').val(searchItemValue);
            $('#searchText').val(searchItemValue);
        }
        if(filterTransValue){
            $('#filterTransaksi').val(filterTransValue);
            $('#selectedTrans').val(filterTransValue);
        }
        if(tglAwalValue){
            $('#datepicker').val(tglAwalValue);
            $('#tglAwal').val(tglAwalValue);
        }
        if(tglAkhirValue){
            $('#datepicker2').val(tglAkhirValue);
            $('#tglAkhir').val(tglAkhirValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var selectedGudang = $('#filterGudang').val();
        var searchText = $('#searchItem').val();
        var selectedTrans = $('#filterTransaksi').val();
        var tglAwal = $('#datepicker').val();
        var tglAkhir = $('#datepicker2').val();

        sessionStorage.setItem('filterGudangKartu', selectedGudang);
        sessionStorage.setItem('searchItemKartu', searchText);
        sessionStorage.setItem('filterTrans', selectedTrans);
        sessionStorage.setItem('tglAwal', tglAwal);
        sessionStorage.setItem('tglAkhir', tglAkhir);
    }

    function updateTableData(page){
        var gudangKartu = $('#filterGudang').val();
        var searchKartu = $('#searchItem').val();
        var selectedTrans = $('#filterTransaksi').val();
        var tanggalAwal = $('#datepicker').val();
        var tanggalAkhir = $('#datepicker2').val();

        $.ajax({
            url: "{{route('kartuStok')}}",
            type: "GET",
            data: {gudangKartu: gudangKartu, searchKartu: searchKartu, selectedTrans: selectedTrans, tglAwal: tanggalAwal, tglAkhir: tanggalAkhir, page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $("#allDates").click(function(){
        $("#datepicker").val("");
        $("#datepicker2").val("");
        saveFilters(); 
        updateTableData(1); 
    });

    $('#filterGudang, #searchItem, #filterTransaksi, #datepicker, #datepicker2').on('change keyup', function(){
        saveFilters();
        updateTableData(1);
    });

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);

    $("#unduhPdf").click(function(){
        var gudangBarang = $('#filterGudang').val();
        var searchText = $('#searchItem').val();
        var selectedTrans = $('#filterTransaksi').val();
        var tanggalAwal = $('#datepicker').val();
        var tanggalAkhir = $('#datepicker2').val();

        $('#selectedGudang').val(gudangBarang);
        $('#searchText').val(searchText);
        $('#selectedTrans').val(selectedTrans);
        $('#tglAwal').val(tanggalAwal);
        $('#tglAkhir').val(tanggalAkhir);

        $('#pdfForm').submit();
    });
  });
</script>
@endsection