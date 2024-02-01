@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="mb-3">{{ $post->title }}</h2>
            <p>By
                <a href="/posts?user={{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> in 
                <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
            </p>

            {{-- POST IMAGE --}}
            @if ($post->image) {{-- jika ada foto diupload --}}
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3 d-flex" alt="{{ $post->category->name }}"
                {{-- PERKONDISIAN JIKA FOTO UKURANNYA BERANTAKAN --}}
                @if ($post->height > 400 && $post->width < 1200) 
                    style="height: 400px"
                @elseif($post->height < 400 && $post->width > 1200)
                    style="width: 1200px"
                @endif>
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
            @endif
            
            {{-- POST BODY --}}
            <article class="my-3">
                {!! $post->body !!}
            </article>
            {{-- agar tidak mengandung htmlspecialshar --}}
            <a href="/posts" class="text-decoration-none">Back</a>
        </div>
    </div>
</div>
@endsection

