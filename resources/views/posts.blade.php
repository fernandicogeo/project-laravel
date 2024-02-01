@extends('layouts/template')

@section('content')
    <h1 class="text-center mb-3">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts" method="get">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('user'))
                    <input type="hidden" name="user" value="{{ request('user') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- GIANT POST --}}
    @if ($posts->count() > 0)
        <div class="card mb-3">

            {{-- POST IMAGE --}}
            @if ($posts[0]->image) {{-- jika ada foto diupload --}}
                <div class="d-flex justify-content-center" 
                {{-- PERKONDISIAN JIKA FOTO UKURANNYA BERANTAKAN --}}
                @if ($posts[0]->height > 400 && $posts[0]->width < 1200) 
                    style="height: 400px"
                @elseif($posts[0]->height < 400 && $posts[0]->width > 1200)
                    style="width: 1200px"
                @elseif($posts[0]->height > 400 && $posts[0]->width > 1200)
                    style="max-width: 1200px; max-height: 400px; overflow: hidden;"
                @endif>
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" class="img-fluid" alt="{{ $posts[0]->category->name }}" 
                    @if ($posts[0]->height > 400 && $posts[0]->width < 1200) 
                        style="height: 400px"
                    @elseif($posts[0]->height < 400 && $posts[0]->width > 1200)
                        style="width: 1200px"
                    @elseif($posts[0]->height > 400 && $posts[0]->width > 1200)
                        style="max-width: 1200px; max-height: 400px; overflow: hidden;"
                    @endif>
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="img-fluid" alt="{{ $posts[0]->category->name }}">
            @endif

            {{-- POST BODY --}}
            <div class="card-body text-center">
                <h2 class="card-title">
                    <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a>
                </h2>
                <p>
                    <small class="text-muted">By 
                        <a href="/posts?user={{ $posts[0]->user->username }}" class="text-decoration-none">{{ $posts[0]->user->name }}</a> in 
                        <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p> 
                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-dark">Read more..</a>
                <p class="card-text"></p>
            </div>
        </div>

    {{-- POSTS --}}
    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                            <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">
                                {{ $post->category->name }}
                            </a>
                        </div>

                        {{-- POST IMAGE --}}
                        @if ($post->image) {{-- jika ada foto diupload --}}
                        <div 
                        {{-- PERKONDISIAN JIKA FOTO UKURANNYA BERANTAKAN --}}
                        @if ($post->height > 400 && $post->width < 500) 
                            style="height: 400px"
                        @elseif($post->height < 400 && $post->width > 500)
                            style="width: 500px"
                        @elseif($post->height > 400 && $post->width > 500)
                            style="max-width: 500px; height: 400px; overflow: hidden;"
                        @endif>
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->category->name }}">
                        </div>
                        @else
                            <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
                        @endif

                        {{-- POST BODY --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p>
                                <small class="text-muted">By 
                                    <a href="/posts?user={{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a>
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                            </p>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <a href="/post/{{ $post->slug }}" class="text-decoration-none btn btn-dark">Read more..</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @else
        <p class="text-center fs-4">No post found.</p>
    @endif

    <div class="d-flex justify-content-center">
        {{-- untuk next page di pagination --}}
        {{ $posts->links() }}
    </div>
    
    
@endsection