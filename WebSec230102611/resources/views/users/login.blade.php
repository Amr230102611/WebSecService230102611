@extends('layouts.master')
@section('title', 'Login')
@section('content')
<div class="d-flex justify-content-center">
  <div class="card m-4 col-sm-6">
    <div class="card-body">
      <h4 class="card-title text-center mb-4">Login</h4>
      <form action="{{route('do_login')}}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          <strong>Error!</strong> {!! htmlspecialchars($error) !!}
        </div>
        @endforeach
      </div>
      <div class="form-group mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" class="form-control" placeholder="Email" name="email" required autocomplete="email">
      </div>
      <div class="form-group mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
      </div>
      <div class="form-group mb-4">
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </div>
    </form>
    
    <div class="social-login mt-4">
      <p class="text-center">or login with</p>
      <div class="d-flex justify-content-center gap-2">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-outline-danger">
          <i class="bi bi-google"></i> Google
        </a>
        <a href="{{ route('social.redirect', ['provider' => 'github']) }}" class="btn btn-outline-dark">
          <i class="bi bi-github"></i> GitHub
        </a>
        <a href="{{ route('social.redirect', ['provider' => 'linkedin']) }}" class="btn btn-outline-primary">
          <i class="bi bi-linkedin"></i> LinkedIn
        </a>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection
