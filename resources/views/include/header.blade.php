<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      nav {
        background-color: pink;
      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    @auth
    <br><br>
    <button class="navbar-toggler2 position-absolute start-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav-drawer" aria-controls="navDrawer">
      <span class="navbar-toggler-icon"></span>
    </button>
    @else
    <div class="navbar-brand-left">
    @endauth
    <div class="position-absolute @if(!Auth::check()) start-0 @endif" style="left: 60px;">
      <span class="navbar-brand">{{config('app.name')}}</span>
    </div>
    @auth
    @else
    </div>
    @endauth
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @auth
        @else
            {{--<li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>--}}
            {{--<li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>--}}
        @endauth
      </ul>
    </div>
  </div>
</nav>
</body>
</html>