@extends('layout')
@section('title','Penjualan Belum Terkirim')
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
<div style="margin-left: 20px;">
    <h3 style="display: inline-block; margin-right: 20px;">Daftar Penjualan Belum Terkirim</h3>
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
        <th>Detail Nota</th>
        <th>Status Pengiriman</th>
      </tr>
    </thead>
    <tbody>
        @foreach($kirim as $k)
            <tr id="tr_{{$k->no_bukti}}">
                <td>{{$k->no_bukti}}</td>
                <td>{{$k->tanggal}}</td>
                <td>{{$k->jatuh_tempo}}</td>
                <td>{{$k->customer->nama_cust}}</td>
                <td>{{$k->customer->alm_1}}, {{$k->customer->alm_2}}, {{$k->customer->alm_3}}</td>
                <td>Rp. {{number_format(floatval($k->sub_total), 2, ',', '.')}}</td>
                <td>{{$k->persen_ppn}}%</td>
                <td>Rp. {{number_format(floatval($k->total), 2, ',', '.')}}</td>
                <td style="text-align: center;"><a class='btn btn-info' href="{{route('JualDetail',$k->no_bukti)}}">Details</a></td>
                <td style="text-align: center;">
                @if($k->status == "Belum Terkirim")
                  <button class='btn btn-danger btn-update-kirim' data-toggle="modal" data-target="#dateModalJual">Belum Terkirim</button>
                @else
                  <button class='btn btn-success btn-update-kirim' style="pointer-events: none; cursor: default;">Terkirim tanggal {{$k->tgl_terkirim}}</button>
                @endif
                </td>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
            url: "{{route('JualKirim')}}",
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