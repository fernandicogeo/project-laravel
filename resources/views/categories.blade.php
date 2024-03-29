@extends('layouts/template')

@section('content')
    <h1>Post Categories</h1>
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <a href="/posts?category={{ $category->slug }}">       
                        <div class="card bg-dark">
                            <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">

                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title flex-fill text-center p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a> 
                </div>
            @endforeach
        </div>
    </div>
    

        {{-- <a href="/categories/{{ $category->slug }}" class="text-decoration-none"><h2>{{ $category->name }}</h2></a> --}}
    
@endsection