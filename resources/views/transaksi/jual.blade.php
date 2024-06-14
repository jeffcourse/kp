@extends('layout')
@section('title','Penjualan')
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
        <h4 style="display: inline-block; margin-right: 20px;">Daftar Penjualan</h4>
        <a style="margin-right: 20px;" href="{{route('jual.create')}}" class="btn btn-info">Tambah Transaksi</a>
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
        <th>Nama Customer</th>
        <th>Alamat Kirim</th>
        <th>Harga Sub Total</th>
        <th>PPN</th>
        <th>Harga Total</th>
        <th>Status Pembayaran</th>
        <th>Status Pengiriman</th>
        <th>Detail Nota</th>
        <th>Invoice</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($jual as $j)
            <tr id="tr_{{$j->no_bukti}}">
                <td>{{$j->no_bukti}}</td>
                <td>{{$j->tanggal}}</td>
                <td>{{$j->jatuh_tempo}}</td>
                <td>{{$j->customer->nama_cust}}</td>
                <td>{{$j->customer->alm_1}}, {{$j->customer->alm_2}}, {{$j->customer->alm_3}}</td>
                <td>Rp. {{number_format(floatval($j->sub_total), 2, ',', '.')}}</td>
                <td>{{$j->persen_ppn}}%</td>
                <td>Rp. {{number_format(floatval($j->total), 2, ',', '.')}}</td>
                <td style="text-align: center;">
                @if($j->lunas == "Belum Lunas")
                  <button class='btn btn-danger btn-update-bayar' data-toggle="modal" data-target="#dateModal">Belum Lunas</button>
                @else
                  <button class='btn btn-success btn-update-bayar' style="pointer-events: none; cursor: default;">Lunas tanggal {{$j->tgl_lunas}}</button>
                @endif
                </td>
                <td style="text-align: center;">
                @if($j->status == "Belum Terkirim")
                  <button class='btn btn-danger btn-update-kirim' data-toggle="modal" data-target="#dateModalJual">Belum Terkirim</button>
                @else
                  <button class='btn btn-success btn-update-kirim' style="pointer-events: none; cursor: default;">Terkirim tanggal {{$j->tgl_terkirim}}</button>
                @endif
                </td>
                <td style="text-align: center;"><a class='btn btn-info' href="{{route('JualDetail',$j->no_bukti)}}">Details</a></td>
                <td style="text-align: center;">
                    <a class='btn btn-info' href="{{route('JualPdf',$j->no_bukti)}}">Lihat Invoice</a>  
                </td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    {{--<a class='btn btn-info' href="{{route('jual.edit',$j->no_bukti)}}">Edit</a>--}}
                    <form method="POST" action="{{route('jual.destroy',$j->no_bukti)}}">
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
</div>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    $(document).on('click', '.btn-update-bayar', function(e) {
      e.preventDefault();
      var trId = $(this).closest('tr').attr('id');
      var noBukti = $(this).closest('tr').find('td:first').text();
      $('#no-bukti').val(noBukti);
      $('#dateModal').modal('show');

      $('#simpanTanggal').click(function() {
        var selectedDate = $('#datepicker-dialog').val();
        var noNota = $('#no-bukti').val(); 
        $.ajax({
          url: "{{route('UpdateBayarJual')}}",
          type: 'GET',
          data: {no_bukti: noNota, tgl_lunas: selectedDate},
          success: function(response) {
            $('#' + trId + ' .btn-update-bayar').removeClass('btn-danger').addClass('btn-success').text('Lunas tanggal ' + selectedDate).css({'pointer-events': 'none', 'cursor': 'default'});
            $('#dateModal').modal('hide');
            $('.modal-backdrop').remove(); 
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
        $('#dateModal').modal('hide');
      });

      $('#datepicker-dialog').flatpickr({
        dateFormat: "d-m-Y",
        defaultDate: "today"
      });
    });

    $(document).on('click', '.btn-update-kirim', function(e){
        e.preventDefault();
        var trId = $(this).closest('tr').attr('id');
        var noBukti = $(this).closest('tr').find('td:first').text();
        $('#no-bukti-kirim').val(noBukti);
        $('#dateModalJual').modal('show');

      $('#simpanTanggalJual').click(function() {
        var selectedDate = $('#datepicker-dialog-kirim').val();
        var noNota = $('#no-bukti-kirim').val(); 
        $.ajax({
          url: "{{route('UpdateKirimJual')}}",
          type: 'GET',
          data: {no_bukti: noNota, tgl_terkirim: selectedDate},
          success: function(response) {
            $('#' + trId + ' .btn-update-kirim').removeClass('btn-danger').addClass('btn-success').text('Terkirim tanggal ' + selectedDate).css({'pointer-events': 'none', 'cursor': 'default'});
            $('#dateModalJual').modal('hide');
            $('.modal-backdrop').remove(); 
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
        $('#dateModalJual').modal('hide');
      });

      $('#datepicker-dialog-kirim').flatpickr({
        dateFormat: "d-m-Y",
        defaultDate: "today"
      });
    });
  });
</script>

<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModalLabel">Ubah Status Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Nomor Nota:</h5>
        <input type="text" id="no-bukti" class="form-control" readonly><br>
        <h5>Tanggal Pembayaran:</h5>
        <input type="text" id="datepicker-dialog" class="form-control" placeholder="Pilih tanggal...">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpanTanggal">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dateModalJual" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModalLabel">Ubah Status Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Nomor Nota:</h5>
        <input type="text" id="no-bukti-kirim" class="form-control" readonly><br>
        <h5>Tanggal Terkirim:</h5>
        <input type="text" id="datepicker-dialog-kirim" class="form-control" placeholder="Pilih tanggal...">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpanTanggalJual">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endsection