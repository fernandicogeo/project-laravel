@extends('layouts.template')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-5">
    <main class="form-signin">
      <h1 class="h3 mb-3 fw-normal text-center">Login here!</h1>
      
      {{-- ALERT SUCCESS REGISTRATION --}}
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      {{-- ALERT LOGIN FAILED --}}
      @if (session()->has('loginFailed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginFailed') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form action="/login" method="post">
        @csrf
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus required>
          <label for="email">Email address</label>

          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      </form>
      <small class="d-block text-center mt-3">Don't have an account? <a href="/register">Register here!</a></small>
    </main>
  </div>
</div>
@endsection