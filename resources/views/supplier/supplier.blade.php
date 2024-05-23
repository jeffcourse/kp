@extends('layout')
@section('title','Supplier')
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
    <h3 style="display: inline-block; margin-right: 20px;">Supplier Table</h3>
    <a href="{{route('supplier.create')}}" class="btn btn-success">Tambah Supplier</a><br>
</div><br>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<table class="table" style="margin-left: 40px; margin-right: 80px;">
    <thead>
      <tr>
        <th>Kode Supplier</th>
        <th>Nama Barang</th>
        <th>Bank Account</th>
        <th>Alamat 1</th>
        <th>Alamat 2</th>
        <th>Kota</th>
        <th>Negara</th>
        <th>Kontak</th>
        <th>Jabatan</th>
        <th>No Telp</th>
        <th>Email</th>
        <th>Saldo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($supplier as $s)
            <tr id="tr_{{$s->kode_supp}}">
                <td>{{$s->kode_supp}}</td>
                <td>{{$s->nama_supp}}</td>
                <td>{{$s->acc_bank}}</td>
                <td>{{$s->alm_1}}</td>
                <td>{{$s->alm_2}}</td>
                <td>{{$s->kota}}</td>
                <td>{{$s->negara}}</td>
                <td>{{$s->kontak}}</td>
                <td>{{$s->jabatan}}</td>
                <td>{{$s->no_telp}}</td>
                <td>{{$s->email}}</td>
                <td>Rp. {{number_format($s->saldo, 0, ',', '.')}}</td>
                <td>
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                    <a class='btn btn-info' href="{{route('supplier.edit',$s->kode_supp)}}">Update</a>
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
@endsection