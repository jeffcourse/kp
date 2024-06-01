@extends('layout')
@section('title','Customer')
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
  <div class="d-flex justify-content-left align-items-center">
    <h4 style="display: inline-block; margin-right: 20px;">Customer Table</h4>
    <a href="{{ route('customer.create') }}" class="btn btn-info" style="margin-right: 10px;">Tambah Customer</a>
    <input style="width: 170px; display: inline-block;" type="text" id="searchItem" class="form-control" placeholder="Cari nama customer">
  </div>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th>Kode Customer</th>
        <th>Nama Customer</th>
        <th>Tipe Customer</th>
        <th>Alamat 1</th>
        <th>Alamat 2</th>
        <th>Alamat 3</th>
        <th>Kota</th>
        <th>Kontak</th>
        <th>No Telp</th>
        <th>Nama Sales</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($customer as $c)
            <tr id="tr_{{$c->kode_cust}}">
                <td>{{$c->kode_cust}}</td>
                <td>{{$c->nama_cust}}</td>
                <td>{{$c->type_cust}}</td>
                <td>{{$c->alm_1}}</td>
                <td>{{$c->alm_2}}</td>
                <td>{{$c->alm_3}}</td>
                <td>{{$c->kota}}</td>
                <td>{{$c->kontak}}</td>
                <td>{{$c->no_telp}}</td>
                <td>{{$c->salesPerson->nama_sales}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="{{route('customer.edit',$c->kode_cust)}}">Edit</a>
                    <form method="POST" action="{{route('customer.destroy',$c->kode_cust)}}">
                      @csrf
                      @method('DELETE')
                      <input style="width: 75px;" type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$c->kode_cust}} - {{$c->nama_cust}} ?');">
                    </form>
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if ($customer->hasPages())
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if($customer->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$customer->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $customer->lastPage(); $i++)
            @if($i >= $customer->currentPage() - 2 && $i <= $customer->currentPage() + 2)
                @if($i == $customer->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$customer->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($customer->hasMorePages())
            <li><a href="{{$customer->nextPageUrl()}}" rel="next">&raquo;</a></li>
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
        var searchItemValue = sessionStorage.getItem('searchCustomer');
        if (searchItemValue) {
            $('#searchItem').val(searchItemValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var searchText = $('#searchItem').val();
        sessionStorage.setItem('searchCustomer', searchText);
    }

    function updateTableData(page){
        var searchText = $('#searchItem').val();

        $.ajax({
            url: "{{route('customer')}}",
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