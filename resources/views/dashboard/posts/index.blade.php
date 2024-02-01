@extends('dashboard.layouts.template')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-2">
    <h1 class="h2">My Posts</h1>
  </div>

  {{-- ALERT SUCCESS ADDED NEW POST --}}
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="table-responsive col-lg-8">
    <a href="/dashboard/posts/create" class="btn btn-dark mb-3">Create New Post</a> {{-- hrefnya harus /create agar bisa terhubung ke resource --}}
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($posts as $post)
          <tr>
            <td>{{ $loop->iteration }}</td> {{-- looping angka 1 sampai n (sebanyak post) --}}
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
                {{-- READ POST --}}
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>

                {{-- EDIT POST --}}
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>

                {{-- DELETE POST --}}
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline"> {{-- harus mengirimkan slug agar dapat mengambil post yang akan dihapus --}}
                  @csrf
                  @method('delete') {{-- untuk mengganti method post pada form menjadi method delete --}}

                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                  
                </form>
            </td>
          </tr> 
          @endforeach
      </tbody>
    </table>
  </div>
@endsection