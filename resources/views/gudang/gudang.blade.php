@extends('layout')
@section('title','Gudang')
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
        width: 720px;
    }
  </style>
</head>

<div class="mt-5">
<div class="d-flex flex-column flex-md-row align-items-md-center" style="margin-left: 20px;">
    <div class="d-flex justify-content-left align-items-center">
      <h4 style="display: inline-block; margin-right: 20px;">Daftar Gudang</h4>
      <a style="margin-right: 20px;" href="{{route('gudang.create')}}" class="btn btn-info">Tambah Gudang</a>
    </div>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-container" style="margin-left: 20px; margin-right: 20px;">
  <table class="table table-striped table-bordered" style="margin-right: 20px;">
    <thead>
      <tr>
        <th style="width: 80px;">Kode</th>
        <th style="width: 170px;">Nama</th>
        <th style="width: 200px;">Alamat</th>
        <th style="width: 170px;">Keterangan</th>
        <th style="width: 100px;">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($gudang as $g)
            <tr id="tr_{{$g->kode}}">
                <td>{{$g->kode}}</td>
                <td>{{$g->nama}}</td>
                <td>{{$g->alamat}}</td>
                <td>{{$g->keterangan}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="{{route('gudang.edit',$g->kode)}}">Edit</a>
                    <form method="POST" action="{{route('gudang.destroy', $g->kode)}}">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$g->kode}} - {{$g->nama}} ?');">Delete</button>
                    </form>
                  </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
  <div class="text-center">
    @if($gudang->hasPages())
      <ul id="pagination" class="pagination">
        {{-- Previous Page Link --}}
        @if($gudang->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$gudang->previousPageUrl()}}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @for($i = 1; $i <= $gudang->lastPage(); $i++)
            @if($i >= $gudang->currentPage() - 2 && $i <= $gudang->currentPage() + 2)
                @if($i == $gudang->currentPage())
                    <li class="active"><span>{{$i}}</span></li>
                @else
                    <li><a href="{{$gudang->url($i)}}">{{$i}}</a></li>
                @endif
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if($gudang->hasMorePages())
            <li><a href="{{$gudang->nextPageUrl()}}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    @endif
  </div><br><br>
</div>

<script>
  $(document).ready(function(){
    function updateTableData(page){

        $.ajax({
            url: "{{route('gudang')}}",
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
  });
</script>
@endsection