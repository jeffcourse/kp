@extends('layout')
@section('title','Penjualan')
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
    <h3 style="display: inline-block; margin-right: 20px;">Daftar Penjualan</h3>
    <a style="margin-right: 20px;" href="#" class="btn btn-success">Tambah Transaksi</a>
    <h4 style="display: inline-block;">Filter berdasarkan tanggal:</h4>
    <input type="text" id="datepicker" class="form-control" style="width: 200px; display: inline-block; margin-left: 10px;" placeholder="dd-mm-yyyy">
    <button id="allDates" class="btn btn-primary" style="margin-left: 10px;">All Dates</button>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<table class="table" style="margin-left: 40px; margin-right: 80px;">
    <thead>
      <tr>
        <th>Nomor Nota</th>
        <th>Tanggal</th>
        <th>Nama Supplier</th>
        <th>Mata Uang</th>
        <th>Harga Sub Total</th>
        <th>PPN</th>
        <th>Harga Total</th>
        <th>Status Pembayaran</th>
        <th>Status Pengiriman</th>
        <th>Detail Nota</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($jual as $j)
            <tr id="tr_{{$j->no_bukti}}">
                <td>{{$j->no_bukti}}</td>
                <td>{{$j->tanggal}}</td>
                <td>{{$j->customer->nama_cust}}</td>
                <td>{{$j->mata_uang}}</td>
                <td>Rp. {{number_format($j->sub_total, 0, ',', '.')}}</td>
                <td>{{$j->persen_ppn}}%</td>
                <td>Rp. {{number_format($j->total, 0, ',', '.')}}</td>
                <td><a class='btn {{$j->lunas == "Belum Lunas" ? "btn-danger" : "btn-success"}} btn-update-bayar' href="{{route('UpdateBayarJual',$j->no_bukti)}}" @if($j->lunas == "Lunas") style="pointer-events: none; cursor: default;" @endif>{{$j->lunas}}</a></td>
                <td><a class='btn {{$j->status == "Belum Terkirim" ? "btn-danger" : "btn-success"}} btn-update-kirim' href="{{route('UpdateKirimJual',$j->no_bukti)}}" @if($j->status == "Sudah Terkirim") style="pointer-events: none; cursor: default;" @endif>{{$j->status}}</a></td>
                <td><a class='btn btn-info' href="#">Details</a></td>
                <td>
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="#">Update</a>
                    <form method="POST" action="#">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$j->no_bukti}} - {{$j->tanggal}} ?');">Delete</button>
                    </form>
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  <div class="text-center">
    @if($jual->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($jual->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$jual->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $jual->lastPage(); $i++)
            @if($i >= $jual->currentPage() - 2 && $i <= $jual->currentPage() + 2)
                @if($i == $jual->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$jual->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($jual->hasMorePages())
            <li><a href="{{$jual->nextPageUrl()}}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    @endif
  </div><br><br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-30:+0",
            onClose: function(selectedDate){
                
            }
        });
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
        var filterDateValue = sessionStorage.getItem('filterDateJual');
        if (filterDateValue) {
            $('#datepicker').val(filterDateValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var selectedDate = $('#datepicker').val();

        sessionStorage.setItem('filterDateJual', selectedDate);
    }

    function updateTableData(page){
        var selectedDate = $('#datepicker').val();

        $.ajax({
            url: "{{route('penjualan')}}",
            type: "GET",
            data: {selectedDateJual: selectedDate, page: page},
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