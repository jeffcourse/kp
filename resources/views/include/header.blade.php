<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    @auth
    <button class="navbar-toggler2" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav-drawer" aria-controls="navDrawer">
      <span class="navbar-toggler-icon"></span>
    </button>
    @else
    <div class="navbar-brand-left">
    @endauth
    <div class="position-absolute @if(!Auth::check()) start-0 ms-3 @endif" style="left: 60px;">
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