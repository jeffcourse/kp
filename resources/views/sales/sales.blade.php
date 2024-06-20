@extends('layout')
@section('title','Sales Person')
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
    .table-container{
        width: 500px;
    }
  </style>
</head>

<div class="mt-5">
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center">
      <h4 style="display: inline-block; margin-right: 20px;">Sales Person Table</h4>
      <a style="margin-right: 20px;" href="{{route('salesPerson.create')}}" class="btn btn-info">Tambah Sales Person</a>
    </div>
    <input style="width: 150px; display: inline-block;" type="text" id="searchItem" class="form-control" placeholder="Cari nama sales">
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-container" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th style="width: 100px;">Kode Sales</th>
        <th style="width: 150px;">Nama Sales</th>
        <th style="width: 100px;">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($salesPerson as $s)
            <tr id="tr_{{$s->kode_sales}}">
                <td>{{$s->kode_sales}}</td>
                <td>{{$s->nama_sales}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="{{route('salesPerson.edit',$s->kode_sales)}}">Edit</a>
                    <form method="POST" action="{{route('salesPerson.destroy', $s->kode_sales)}}">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$s->kode_sales}} - {{$s->nama_sales}} ?');">Delete</button>
                    </form>
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if($salesPerson->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($salesPerson->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$salesPerson->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $salesPerson->lastPage(); $i++)
            @if($i >= $salesPerson->currentPage() - 2 && $i <= $salesPerson->currentPage() + 2)
                @if($i == $salesPerson->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$salesPerson->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($salesPerson->hasMorePages())
            <li><a href="{{$salesPerson->nextPageUrl()}}" rel="next">&raquo;</a></li>
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
        var searchItemValue = sessionStorage.getItem('searchItemGudang');
        if (searchItemValue) {
            $('#searchItem').val(searchItemValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var searchText = $('#searchItem').val();

        sessionStorage.setItem('searchItemGudang', searchText);
    }

    function updateTableData(page){
        var searchText = $('#searchItem').val();

        $.ajax({
            url: "{{route('salesPerson')}}",
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