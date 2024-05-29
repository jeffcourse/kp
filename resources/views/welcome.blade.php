@extends('layout')
@section('title','Home')
@section('content')

<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

    <div class="container-fluid py-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @auth
                <h2 class="display-4 fw-bold">Hello {{auth()->user()->name}}, Welcome to Masuya Inventory System</h2>
                @endauth
                <p class="lead">A simple inventory management system.</p>
            </div>
            <div class="col-md-6">
                <img src="https://via.placeholder.com/500x300" alt="ERP System" class="img-fluid">
            </div>
        </div>
      </div>
    </div>

    <div class="container-fluid py-5 bg-light">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-box fa-3x mb-2"></i>
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">{{$totalProducts}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-dollar-sign fa-3x mb-2"></i>
                        <h5 class="card-title">Total Value</h5>
                        <p class="card-text">Rp. {{number_format($totalPrice, 0, ',', '.')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-money-bill-alt fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Pembelian Belum Lunas</h5>
                        <p class="card-text">{{$transLunas}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-truck fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Pembelian Belum Terkirim</h5>
                        <p class="card-text">{{$transStatus}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-hand-holding-usd fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Penjualan Belum Lunas</h5>
                        <p class="card-text">{{$transLunasJual}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-shipping-fast fa-3x mb-2"></i>
                        <h5 class="card-title">Transaksi Penjualan Belum Terkirim</h5>
                        <p class="card-text">{{$transStatusJual}}</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="container-fluid py-5 bg-light">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header">Inventory</h5>
                    <div class="card-body">
                        <p class="card-text">Kelola inventory produk-produk anda</p>
                        <a href="{{ route('master') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header">Transaksi Pembelian</h5>
                    <div class="card-body">
                        <p class="card-text">Kelola transaksi pembelian anda.</p>
                        <a href="{{ route('pembelian') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header">Transaksi Penjualan</h5>
                    <div class="card-body">
                        <p class="card-text">Kelola transaksi penjualan anda.</p>
                        <a href="{{ route('penjualan') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <h5 class="card-header">Reports</h5>
                    <div class="card-body">
                        <p class="card-text">Generate reports to analyze your business performance.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection