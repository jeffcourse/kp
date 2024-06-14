@extends('layout')
@section('title','Master')
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
    <div class="d-flex justify-content-left align-items-center mb-2 mb-md-0">
      <h4 style="display: inline-block;">Filter berdasarkan jenis:</h4>
      <select id="filterJenis" class="form-control" style="width: 200px; display: inline-block;">
        <option value="All">All</option>
          @foreach($jenis as $jn)
            <option value="{{$jn->jenis}}">{{$jn->jenis}}</option>
          @endforeach
      </select>
    </div>
    <input style="width: 200px; display: inline-block;" type="text" id="searchItem" class="form-control" placeholder="Cari kode/nama barang" autocomplete="off">
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
                <td>Rp. {{number_format(floatval($m->hrg_jual), 2, ',', '.')}}</td>
                <td>{{$m->gudang->nama}}</td>
                <td>{{$m->keterangan}}</td>
                <td style="text-align: center;">
                  <div class="btn-group-vertical" role="group" aria-label="Actions">
                  @if(!in_array($m->keterangan, ["BARANG RUSAK", "BARANG EXPIRED", "BARANG RUSAK & EXPIRED"]))
                    <a class='btn btn-info' href="{{route('master.edit',$m->id)}}">Edit</a>
                    <button class='btn btn-danger btn-opname' 
                      data-toggle="modal" 
                      data-kode="{{$m->kode_brg}}"
                      data-nama="{{$m->nama_brg}}"
                      data-divisi="{{$m->kode_divisi}}"
                      data-jenis="{{$m->kode_jenis}}"
                      data-tipe="{{$m->kode_type}}"
                      data-packing="{{$m->packing}}"
                      data-quantity="{{$m->quantity}}"
                      data-satuan="{{$m->id_satuan}}"
                      data-gudang="{{$m->kode_gudang}}"
                      data-toggle="modal" 
                      data-target="#opnameModal">Opname</button>
                  @else
                    <form method="POST" action="{{route('master.destroy', $m->id)}}">
                      @csrf
                      @method('DELETE')
                      <button style="width: 75px;" type="submit" class="btn btn-danger" onclick="return confirm('Do you agree to delete item with {{$m->kode_brg}} - {{$m->nama_brg}} ?');">Delete</button>
                    </form>
                  @endif
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    function loadFilters(){
        var filterGudangValue = sessionStorage.getItem('filterGudang');
        var filterJenisValue = sessionStorage.getItem('filterJenis');
        var searchItemValue = sessionStorage.getItem('searchItem');
        if (filterGudangValue) {
            $('#filterGudang').val(filterGudangValue);
        }
        if (filterJenisValue) {
            $('#filterJenis').val(filterJenisValue);
        }
        if (searchItemValue) {
            $('#searchItem').val(searchItemValue);
        }
    }

    loadFilters();

    function saveFilters(){
        var selectedGudang = $('#filterGudang').val();
        var selectedJenis = $('#filterJenis').val();
        var searchText = $('#searchItem').val();

        sessionStorage.setItem('filterGudang', selectedGudang);
        sessionStorage.setItem('filterJenis', selectedJenis);
        sessionStorage.setItem('searchItem', searchText);
    }

    function updateTableData(page){
        var selectedGudang = $('#filterGudang').val();
        var selectedJenis = $('#filterJenis').val();
        var searchText = $('#searchItem').val();

        $.ajax({
            url: "{{route('master')}}",
            type: "GET",
            data: {gudang: selectedGudang, jenis: selectedJenis, search: searchText, page: page},
            success: function(data){
                $('.table tbody').html($(data).find('.table tbody').html());
                $('.text-center').html($(data).find('.text-center').html());
            }
        });
    }

    $('#filterGudang, #filterJenis, #searchItem').on('change keyup', function(){
        saveFilters();
        updateTableData(1);
    });

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        updateTableData(page);
    });

    updateTableData(1);

    $(document).on('click', '.btn-opname', function(e) {
      e.preventDefault();
      var kodeBrg = $(this).data('kode');
      var namaBrg = $(this).data('nama');
      var divisiBrg = $(this).data('divisi');
      var jenisBrg = $(this).data('jenis');
      var tipeBrg = $(this).data('tipe');
      var packingBrg = $(this).data('packing');
      var quantityBrg = $(this).data('quantity');
      var satuanBrg = $(this).data('satuan');
      var gudangBrg = $(this).data('gudang');

      $('#kode-barang').val(kodeBrg);
      $('#nama-barang').val(namaBrg);
      $('#qty_sistem').val(quantityBrg);
      $('#selisih').attr('max', quantityBrg);
      $('#opnameModal').modal('show');

      $('#simpanOpname').click(function() {
        var quantity = $('#qty_sistem').val();
        var selisih = $('#selisih').val();
        var keterangan = $('#keterangan').val();
        $.ajax({
          url: "{{route('OpnameBarang')}}",
          type: 'GET',
          data: {kode_brg: kodeBrg, nama_brg: namaBrg, kode_divisi: divisiBrg, kode_jenis: jenisBrg, kode_type: tipeBrg, packing: packingBrg,
            quantity: selisih, qty_awal: quantity, id_satuan: satuanBrg, hrg_jual: 0, kode_gudang: gudangBrg, keterangan: keterangan},
          success: function(response) {
            $('#opnameModal').modal('hide');

            $('#kode-barang').val('');
            $('#nama-barang').val('');
            $('#qty_sistem').val('');
            $('#selisih').val('');
            $('.modal-backdrop').remove();
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
        $('#opnameModal').modal('hide');
      });
    });

    $('#opnameModal').on('hidden.bs.modal', function (e) {
      location.reload();
    });
  });
</script>

<div class="modal fade" id="opnameModal" tabindex="-1" role="dialog" aria-labelledby="opnameModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="opnameModalLabel">Opname Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Kode Barang:</h5>
        <input type="text" id="kode-barang" class="form-control" readonly><br>
        <h5>Nama Barang:</h5>
        <input type="text" id="nama-barang" class="form-control" readonly><br>
        <h5>Kuantitas Barang:</h5>
        <input type="number" id="qty_sistem" class="form-control" readonly><br>
        <h5>Kuantitas Barang Rusak/EXP:</h5>
        <input type="number" id="selisih" class="form-control" required><br>
        <h5>Keterangan:</h5>
        <select id="keterangan" class="form-control" style="width: 400px; display: inline-block;">
          <option value="BARANG RUSAK">BARANG RUSAK</option>
          <option value="BARANG EXPIRED">BARANG EXPIRED</option>
          <option value="BARANG RUSAK & EXPIRED">BARANG RUSAK & EXPIRED</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpanOpname">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endsection