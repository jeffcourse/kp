@extends('layout')
@section('title','Register')
@section('content')
<div class="container">
<div class="mt-5">
    @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
                <div class="alert-danger">{{$error}}</div>
            @endforeach
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert-danger">{{session('error')}}</div>
    @endif
    @if(session()->has('success'))
        <div class="alert-success">{{session('success')}}</div>
    @endif
</div>
<form action="{{route('register.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Username</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
@endsection