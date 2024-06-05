@extends('layout')
@section('title','Pembelian')
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
        <h4 style="display: inline-block; margin-right: 20px;">Daftar Pembelian</h4>
        <a style="margin-right: 20px;" href="{{route('beli.create')}}" class="btn btn-info">Tambah Transaksi</a>
    </div>
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
        <h4 style="display: inline-block;">Filter berdasarkan tanggal:</h4>
        <input type="text" id="datepicker" class="form-control" style="width: 150px; display: inline-block; margin-left: 10px;" placeholder="dd-mm-yyyy">
        <button id="allDates" class="btn btn-primary" style="margin-left: 10px;">All Dates</button>
    </div>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th>Nomor Nota</th>
        <th>Tanggal</th>
        <th>Jatuh Tempo</th>
        <th>Nama Supplier</th>
        <th>Kirim Gudang</th>
        <th>Harga Sub Total</th>
        <th>PPN</th>
        <th>Harga Total</th>
        <th>Status Pembayaran</th>
        <th>Status Pengiriman</th>
        <th>Detail Nota</th>
        <th>Faktur Beli</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($beli as $b)
            <tr id="tr_{{$b->no_bukti}}">
                <td>{{$b->no_bukti}}</td>
                <td>{{$b->tanggal}}</td>
                <td>{{$b->jatuh_tempo}}</td>
                <td>{{$b->supplier->nama_supp}}</td>
                <td>{{$b->gudang->nama}}</td>
                <td>Rp. {{number_format($b->sub_total, 0, ',', '.')}}</td>
                <td>{{$b->persen_ppn}}%</td>
                <td>Rp. {{number_format($b->total, 0, ',', '.')}}</td>
                <td style="text-align: center;"><a class='btn {{$b->lunas == "Belum Lunas" ? "btn-danger" : "btn-success"}} btn-update-bayar' href="{{route('UpdateBayar',$b->no_bukti)}}" @if($b->lunas == "Lunas") style="pointer-events: none; cursor: default;" @endif>{{$b->lunas}}</a></td>
                <td style="text-align: center;"><a class='btn {{$b->status == "Belum Terkirim" ? "btn-danger" : "btn-success"}} btn-update-kirim' href="{{route('UpdateKirim',$b->no_bukti)}}" @if($b->status == "Sudah Terkirim") style="pointer-events: none; cursor: default;" @endif>{{$b->status}}</a></td>
                <td style="text-align: center;"><a class='btn btn-info' href="{{route('BeliDetail',$b->no_bukti)}}">Details</a></td>
                <td style="text-align: center;">
                    <a class='btn btn-info' href="{{route('BeliPdf',$b->no_bukti)}}">Lihat Faktur</a>  
                </td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    {{--<a class='btn btn-info' href="{{route('beli.edit',$b->no_bukti)}}">Edit</a>--}}
                    <form method="POST" action="{{route('beli.destroy', $b->no_bukti)}}">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$b->no_bukti}} - {{$b->tanggal}} ?');">Delete</button>
                    </form>
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if($beli->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($beli->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$beli->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $beli->lastPage(); $i++)
            @if($i >= $beli->currentPage() - 2 && $i <= $beli->currentPage() + 2)
                @if($i == $beli->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$beli->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($beli->hasMorePages())
            <li><a href="{{$beli->nextPageUrl()}}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    @endif
  </div><br><br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#datepicker", {
        dateFormat: "d-m-Y",
    });

  $(document).ready(function(){
    function updateStatus(url, message){
        if (confirm(message)){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    updateTableData(1);
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        }
    }

    function loadFilters(){
        var filterDateValue = sessionStorage.getItem('filterDate');
        if (filterDateValue) {
            $('#datepicker').val(filterDateValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var selectedDate = $('#datepicker').val();

        sessionStorage.setItem('filterDate', selectedDate);
    }

    function updateTableData(page){
        var selectedDate = $('#datepicker').val();

        $.ajax({
            url: "{{route('pembelian')}}",
            type: "GET",
            data: {selectedDate: selectedDate, page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $('#datepicker').on('change keyup', function(){
        saveFilters();
        updateTableData(1);
    });

    $("#allDates").click(function(){
        $("#datepicker").val("");
        saveFilters(); 
        updateTableData(1); 
    });

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);

    $(document).on('click', '.btn-update-bayar', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        updateStatus(url, "Apakah anda yakin untuk update status pembayaran pada transaksi ini?");
    });

    $(document).on('click', '.btn-update-kirim', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        updateStatus(url, "Apakah anda yakin untuk update status pengiriman pada transaksi ini?");
    });
  });
</script>
@endsection