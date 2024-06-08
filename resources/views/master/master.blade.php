@extends('layout')
@section('title','Master')
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
    th{
        text-align: center;
    } 
  </style>
</head>

<div class="mt-5">
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center">
      <h4 style="display: inline-block; margin-right: 20px;">Master Table</h4>
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
    <input style="width: 150px; display: inline-block;" type="text" id="searchItem" class="form-control" placeholder="Cari nama barang">
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
        <th>Packing</th>
        <th>Quantity</th>
        <th>Satuan</th>
        <th>Harga Jual</th>
        <th>Gudang</th>
        <th>Keterangan</th>
        <th>Actions</th>
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
                <td>{{$m->packing}}</td>
                <td>{{$m->quantity}}</td>
                <td>{{$m->satuan->satuan}}</td>
                <td>Rp. {{number_format($m->hrg_jual, 0, ',', '.')}}</td>
                <td>{{$m->gudang->nama}}</td>
                <td>{{$m->keterangan}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="{{route('master.edit',$m->id)}}">Edit</a>
                    <form method="POST" action="{{route('master.destroy', $m->id)}}">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$m->kode_brg}} - {{$m->nama_brg}} ?');">Delete</button>
                    </form>
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
<script>
  $(document).ready(function(){
    function loadFilters(){
        var filterGudangValue = sessionStorage.getItem('filterGudang');
        var searchItemValue = sessionStorage.getItem('searchItem');
        if (filterGudangValue) {
            $('#filterGudang').val(filterGudangValue);
        }
        if (searchItemValue) {
            $('#searchItem').val(searchItemValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var selectedGudang = $('#filterGudang').val();
        var searchText = $('#searchItem').val();

        sessionStorage.setItem('filterGudang', selectedGudang);
        sessionStorage.setItem('searchItem', searchText);
    }

    function updateTableData(page){
        var selectedGudang = $('#filterGudang').val();
        var searchText = $('#searchItem').val();

        $.ajax({
            url: "{{route('master')}}",
            type: "GET",
            data: {gudang: selectedGudang, search: searchText, page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $('#filterGudang, #searchItem').on('change keyup', function(){
        saveFilters();
        updateTableData(1);
    });

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);
        
    /*function updateQuantity(id, increment){
      var quantityInput = $('#tr_' + id + ' .input-quantity');
      var currentQuantity = parseInt(quantityInput.val());
      var newQuantity = currentQuantity + increment;
          
      quantityInput.val(newQuantity);

      $.ajax({
        url: "{{route('UpdateQuantity')}}",
        type: "POST",
        data: {
          _token: "{{csrf_token()}}",
          id: id,
          quantity: newQuantity
        },
        success: function(response){
          $('#tr_' + id + ' .hrg_jual_total').text('Rp. ' + response.hrg_jual_total.toLocaleString('id-ID'));
        },
        error: function(xhr, status, error){
          console.error(error);
        }
      });
    }

    $(document).on('click', '.btn-minus', function(){
      var id = $(this).data('id');
      updateQuantity(id, -1);
    });

    $(document).on('click', '.btn-plus', function(){
      var id = $(this).data('id');
      updateQuantity(id, 1);
    });*/
  });
</script>
@endsection