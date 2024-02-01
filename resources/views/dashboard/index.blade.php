@extends('dashboard.layouts.template')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-2">
    <h1 class="h2">My Dashboard</h1>
  </div>

  {{-- ALERT SUCCESS EDITED PROFILE --}}
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

   {{-- ALERT SUCCESS CHANGED PASSWORD --}}
  @if (session()->has('success-pw'))
   <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
     {{ session('success-pw') }}
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
  @endif

  {{-- ALERT FAILED CHANGED PASSWORD --}}
  @if (session()->has('failed-pw'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('failed-pw') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif


  <h5 class="d-flex justify-content-left border-bottom pb-3">Welcome back, {{ $users[0]->name }}</h5>  

  <div class="col-lg-8">

    {{-- EDIT PROFILE --}}
    <a href="/dashboard/{{ $users[0]->username }}/edit" class="btn btn-dark mb-3"><span data-feather="edit"></span> Edit Profile</a>

    {{-- CHANGE PASSWORD --}}
    <a href="/dashboard/{{ $users[0]->username }}/change" class="btn btn-danger mb-3"><span data-feather="edit"></span> Change Password</a>

  </div>
@endsection