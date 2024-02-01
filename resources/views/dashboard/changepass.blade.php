@extends('dashboard.layouts.template')

@section('content')
{{-- TITLE --}}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-2">
  <h1 class="h2">Change Password</h1>
</div>

{{-- FORM --}}
<div class="col-lg-8">
    <form action="/dashboard/{{ $user->username }}" method="post" class="mb-5">
      @csrf
      <div class="mb-3">

        {{-- OLD PASSWORD --}}
        <label for="old_password" class="form-label">Old Password</label>
        <input type="password" class="form-control" id="old_password" name="old_password" value="{{ old('old_password', $user->old_password) }}" required autofocus>

        {{-- NEW PASSWORD --}}
        <label for="new_password" class="form-label mt-3">New Password</label>
        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" value="{{ old('new_password', $user->new_password) }}" required>
        @error('new_password')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror

        {{-- CONFIRM NEW PASSWORD --}}
        <label for="conf_new_password" class="form-label mt-3">Confirm New Password</label>
        <input type="password" class="form-control @error('conf_new_password') is-invalid @enderror" id="conf_new_password" name="conf_new_password" value="{{ old('conf_new_password', $user->conf_new_password) }}" required>
        @error('conf_new_password')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror

        
        
        <button type="submit" class="btn btn-primary mt-4">Edit Profile</button>

      </div>

      
    </form>
</div>

@endsection