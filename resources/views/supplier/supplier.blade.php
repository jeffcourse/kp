@extends('layout')
@section('title','Supplier')
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
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;" class="col">
  <div class="d-flex justify-content-left align-items-center">
    <h4 style="display: inline-block; margin-right: 20px;">Supplier Table</h4>
    <a href="{{route('supplier.create')}}" class="btn btn-info">Tambah Supplier</a>
    <input style="width: 150px; display: inline-block; margin-left: 10px;" type="text" id="searchItem" class="form-control" placeholder="Cari nama supplier" autocomplete="off">
  </div>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th>Kode Supplier</th>
        <th>Nama Supplier</th>
        <th>Bank</th>
        <th>Nomor Rekening</th>
        <th>Alamat Supplier</th>
        <th>Kota</th>
        <th>Negara</th>
        <th>Kontak</th>
        <th>Jabatan</th>
        <th>No Telp</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($supplier as $s)
            <tr id="tr_{{$s->kode_supp}}">
                <td>{{$s->kode_supp}}</td>
                <td>{{$s->nama_supp}}</td>
                <td>{{$s->bank}}</td>
                <td>{{$s->acc_bank}}</td>
                <td>{{$s->alm_1}}, {{$s->alm_2}}</td>
                <td>{{$s->kota}}</td>
                <td>{{$s->negara}}</td>
                <td>{{$s->kontak}}</td>
                <td>{{$s->jabatan}}</td>
                <td>{{$s->no_telp}}</td>
                <td>{{$s->email}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="{{route('supplier.edit',$s->kode_supp)}}">Edit</a>
                    <form method="POST" action="{{route('supplier.destroy',$s->kode_supp)}}">
                      @csrf
                      @method('DELETE')
                      <input style="width: 75px;" type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$s->kode_supp}} - {{$s->nama_supp}} ?');">
                    </form>
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if ($supplier->hasPages())
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if($supplier->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$supplier->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $supplier->lastPage(); $i++)
            @if($i >= $supplier->currentPage() - 2 && $i <= $supplier->currentPage() + 2)
                @if($i == $supplier->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$supplier->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($supplier->hasMorePages())
            <li><a href="{{$supplier->nextPageUrl()}}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    @endif
  </div><br><br>
</div>

<script>
  $(document).ready(function(){
    function loadFilters(){
        var searchItemValue = sessionStorage.getItem('searchSupplier');
        if (searchItemValue) {
            $('#searchItem').val(searchItemValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var searchText = $('#searchItem').val();
        sessionStorage.setItem('searchSupplier', searchText);
    }

    function updateTableData(page){
        var searchText = $('#searchItem').val();

        $.ajax({
            url: "{{route('supplier')}}",
            type: "GET",
            data: {search: searchText, page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $('#searchItem').on('change keyup', function(){
        saveFilters();
        updateTableData(1);
    });

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);
  });
</script>
@endsection