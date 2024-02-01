@extends('dashboard.layouts.template')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-8">
            <h2 class="my-4">{{ $post->title }}</h2>

            {{-- BACK TO MY POST --}}
            <a href="/dashboard/posts" class="btn btn-dark"><span data-feather="arrow-left"></span> Back to My Posts</a>

            {{-- EDIT POST --}}
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>

            {{-- DELETE POST --}}
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline"> {{-- harus mengirimkan slug agar dapat mengambil post yang akan dihapus --}}
                @csrf
                @method('delete') {{-- untuk mengganti method post pada form menjadi method delete --}}

                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
            </form>
            
            {{-- POST IMAGE --}}
            @if ($post->image) {{-- jika ada foto diupload --}}
              <div style="max-height: 400px; max-width: 1200px; overflow: hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3 d-flex" alt="{{ $post->category->name }}" 
                {{-- PERKONDISIAN JIKA FOTO UKURANNYA BERANTAKAN --}}
                @if ($post->height > 400 && $post->width < 1200) 
                    style="height: 400px"
                @elseif($post->height < 400 && $post->width > 1200)
                    style="width: 1200px"
                @endif>
              </div>
            @else
              <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
            @endif
            
            <article class="my-3 max-width-5">
                {!! $post->body !!}
            </article>
        </div>
    </div>
</div>
@endsection