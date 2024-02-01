@extends('dashboard.layouts.template')

@section('content')
{{-- TITLE --}}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-2">
  <h1 class="h2">Edit Profile</h1>
</div>

{{-- FORM --}}
<div class="col-lg-8">
    <form action="/dashboard/{{ $user->username }}" method="post" class="mb-5">
      @csrf
      @method('put')
      <div class="mb-3">

        {{-- NAME --}}
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror

        {{-- USERNAME --}}
        <label for="username" class="form-label mt-3">Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        @error('username')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror

        {{-- EMAIL --}}
        <label for="email" class="form-label mt-3">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div> 
        @enderror
        
        <button type="submit" class="btn btn-primary mt-4">Edit Profile</button>

      </div>

      
    </form>
</div>

@endsection