@extends('layout')
@section('title','Pembelian Belum Terkirim')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
  </style>
</head>

<div class="mt-5">
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <h3 style="display: inline-block; margin-right: 20px;">Daftar Pembelian Belum Terkirim</h3>
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
        <th>Nama Supplier</th>
        <th>Mata Uang</th>
        <th>Kirim Gudang</th>
        <th>Harga Sub Total</th>
        <th>PPN</th>
        <th>Harga Total</th>
        <th>Detail Nota</th>
        <th>Status Pengiriman</th>
      </tr>
    </thead>
    <tbody>
        @foreach($kirim as $k)
            <tr id="tr_{{$k->no_bukti}}">
                <td>{{$k->no_bukti}}</td>
                <td>{{$k->tanggal}}</td>
                <td>{{$k->supplier->nama_supp}}</td>
                <td>{{$k->mata_uang}}</td>
                <td>{{$k->gudang->nama}}</td>
                <td>Rp. {{number_format($k->sub_total, 0, ',', '.')}}</td>
                <td>{{$k->persen_ppn}}%</td>
                <td>Rp. {{number_format($k->total, 0, ',', '.')}}</td>
                <td style="text-align: center;"><a class='btn btn-info' href="{{route('BeliDetail',$k->no_bukti)}}">Details</a></td>
                <td style="text-align: center;"><a class='btn {{$k->status == "Belum Terkirim" ? "btn-danger" : "btn-success"}} btn-update-kirim' href="{{route('UpdateKirim',$k->no_bukti)}}" @if($k->status == "Sudah Terkirim") style="pointer-events: none; cursor: default;" @endif>{{$k->status}}</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if($kirim->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($kirim->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$kirim->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $kirim->lastPage(); $i++)
            @if($i >= $kirim->currentPage() - 2 && $i <= $kirim->currentPage() + 2)
                @if($i == $kirim->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$kirim->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($kirim->hasMorePages())
            <li><a href="{{$kirim->nextPageUrl()}}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    @endif
  </div><br><br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

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

    function updateTableData(page){

        $.ajax({
            url: "{{route('BeliKirim')}}",
            type: "GET",
            data: {page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);

    $(document).on('click', '.btn-update-kirim', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        updateStatus(url, "Apakah anda yakin untuk update status pengiriman pada transaksi ini?");
    });
  });
</script>
@endsection