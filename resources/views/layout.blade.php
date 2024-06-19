<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: lightblue !important;
      }
    </style>
  </head>
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          @include('include.header')
          @yield('content')
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <body>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="nav-drawer" aria-labelledby="navDrawerLabel" style="width: 300px;">
      <div class="offcanvas-header" style="background-color: lightgray;">
        <h5 class="offcanvas-title" id="navDrawerLabel">
        @auth
        {{auth()->user()->name}}
        @endauth
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="background-color: red;"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: auto;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('master') }}">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('gudang') }}">Gudang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kartuStok') }}">Log Mutasi</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="pembayaranDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transaksi</a>
              <div class="dropdown-menu" aria-labelledby="pembayaranDropdown">
                <a class="dropdown-item" href="{{ route('pembelian') }}">Pembelian</a>
                <a class="dropdown-item" href="{{ route('penjualan') }}">Penjualan</a>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supplier') }}">Supplier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer') }}">Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('salesPerson') }}">Sales Person</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </li>
            @endauth
        </ul>
      </div>
    </div>
  </body>
</html>