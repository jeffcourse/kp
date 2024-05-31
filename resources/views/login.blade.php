@extends('layout')
@section('title','Login')
@section('content')
<div class="container">
<div class="mt-5">
    @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
</div>
<form action="{{route('login.post')}}" method="POST" class="d-flex flex-column align-items-center" style="max-width: 500px; margin: auto;">
  @csrf
  <div class="mb-3 row">
    <label for="name" class="form-label">Username</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name="name">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="password" class="form-label">Password</label>
    <div class="col-sm-12">
      <input type="password" class="form-control" name="password">
    </div>
  </div>
  <div class="mb-3 row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
  </div>
</form>
</div>
@endsection