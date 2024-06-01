@extends('layout')
@section('title','Home')
@section('content')

<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .content-container {
        background-color: lightblue;
    }
    img {
      width: 450px; 
      height: auto; 
    }
</style>
</head>
    <div class="content-container py-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @auth
                <h2 class="display-4 fw-bold">Halo {{auth()->user()->name}}, Welcome to Masuya Inventory System</h2>
                @endauth
                <p class="lead">A simple inventory management system.</p>
            </div>
            <div class="col-md-6">
                <img src="https://cdn.triloker.com/d:300/company/logo/20200716/0e8dc57505462b24df0deef98afb6514ba46dae81594867235.png" alt="ERP System" class="img-fluid">
            </div>
        </div>
      </div>
    </div>
    <div class="content-container py-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body" style="background-color: yellow;">
                        <i class="fas fa-box fa-3x mb-2"></i>
                        <h5 class="card-title">Total Produk</h5>
                        <h4 class="card-text">{{$totalProducts}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body" style="background-color: yellow;">
                        <i class="fas fa-dollar-sign fa-3x mb-2"></i>
                        <h5 class="card-title">Total Value</h5>
                        <h4 class="card-text">Rp. {{number_format($totalPrice, 0, ',', '.')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body" 
                        @if($transLunas == 0)
                            style="cursor: not-allowed; pointer-events: none; background-color: green;"
                        @else
                            onclick="window.location='{{route('BeliLunas')}}';" style="cursor:pointer; background-color: red;"
                        @endif>
                        <i class="fas fa-money-bill-alt fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Pembelian Belum Lunas</h5>
                        <h4 class="card-text">{{$transLunas}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body" 
                        @if($transStatus == 0)
                            style="cursor: not-allowed; pointer-events: none; background-color: green;"
                        @else
                            onclick="window.location='{{route('BeliKirim')}}';" style="cursor:pointer; background-color: red;"
                        @endif>
                        <i class="fas fa-truck fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Pembelian Belum Terkirim</h5>
                        <h4 class="card-text">{{$transStatus}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body" 
                        @if($transLunasJual == 0)
                            style="cursor: not-allowed; pointer-events: none; background-color: green;"
                        @else
                            onclick="window.location='{{route('JualLunas')}}';" style="cursor:pointer; background-color: red;"
                        @endif>
                        <i class="fas fa-hand-holding-usd fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Penjualan Belum Lunas</h5>
                        <h4 class="card-text">{{$transLunasJual}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body" 
                        @if($transStatusJual == 0)
                            style="cursor: not-allowed; pointer-events: none; background-color: green;"
                        @else
                            onclick="window.location='{{route('JualKirim')}}';" style="cursor:pointer; background-color: red;"
                        @endif>
                        <i class="fas fa-shipping-fast fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Penjualan Belum Terkirim</h5>
                        <h4 class="card-text">{{$transStatusJual}}</h4>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="content-container py-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header" style="background-color: pink;">Inventory</h5>
                    <div class="card-body">
                        <p class="card-text">Kelola inventory produk-produk anda</p>
                        <a href="{{ route('master') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header" style="background-color: pink;">Transaksi Pembelian</h5>
                    <div class="card-body">
                        <p class="card-text">Kelola transaksi pembelian anda.</p>
                        <a href="{{ route('pembelian') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header" style="background-color: pink;">Transaksi Penjualan</h5>
                    <div class="card-body">
                        <p class="card-text">Kelola transaksi penjualan anda.</p>
                        <a href="{{ route('penjualan') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection