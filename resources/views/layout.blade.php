<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    @include('include.header')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="nav-drawer" aria-labelledby="navDrawerLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="navDrawerLabel">
        @auth
        {{auth()->user()->name}}
        @endauth
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('master') }}">Master</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pembayaranDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transaksi</a>
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