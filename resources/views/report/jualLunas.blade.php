@extends('layout')
@section('title','Penjualan Belum Lunas')
@section('content')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<div class="mt-5">
<div style="margin-left: 40px;">
    <h3 style="display: inline-block; margin-right: 20px;">Daftar Penjualan Belum Lunas</h3>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<table class="table" style="margin-left: 40px; margin-right: 80px;">
    <thead>
      <tr>
        <th>Nomor Nota</th>
        <th>Tanggal</th>
        <th>Nama Customer</th>
        <th>Alamat Kirim</th>
        <th>Mata Uang</th>
        <th>Harga Sub Total</th>
        <th>PPN</th>
        <th>Harga Total</th>
        <th>Detail Nota</th>
        <th>Status Pembayaran</th>
      </tr>
    </thead>
    <tbody>
        @foreach($lunas as $l)
            <tr id="tr_{{$l->no_bukti}}">
                <td>{{$l->no_bukti}}</td>
                <td>{{$l->tanggal}}</td>
                <td>{{$l->customer->nama_cust}}</td>
                <td>{{$l->customer->alm_1}}, {{$l->customer->alm_2}}, {{$l->customer->alm_3}}</td>
                <td>{{$l->mata_uang}}</td>
                <td>Rp. {{number_format($l->sub_total, 0, ',', '.')}}</td>
                <td>{{$l->persen_ppn}}%</td>
                <td>Rp. {{number_format($l->total, 0, ',', '.')}}</td>
                <td><a class='btn btn-info' href="{{route('JualDetail',$l->no_bukti)}}">Details</a></td>
                <td><a class='btn {{$l->lunas == "Belum Lunas" ? "btn-danger" : "btn-success"}} btn-update-bayar' href="{{route('UpdateBayarJual',$l->no_bukti)}}" @if($l->lunas == "Lunas") style="pointer-events: none; cursor: default;" @endif>{{$l->lunas}}</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>
  <div class="text-center">
    @if($lunas->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($lunas->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$lunas->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $lunas->lastPage(); $i++)
            @if($i >= $lunas->currentPage() - 2 && $i <= $lunas->currentPage() + 2)
                @if($i == $lunas->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$lunas->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($lunas->hasMorePages())
            <li><a href="{{$lunas->nextPageUrl()}}" rel="next">&raquo;</a></li>
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
            url: "{{route('JualLunas')}}",
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

    $(document).on('click', '.btn-update-bayar', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        updateStatus(url, "Apakah anda yakin untuk update status pembayaran pada transaksi ini?");
    });
  });
</script>
@endsection