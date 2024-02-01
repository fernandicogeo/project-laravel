@extends('dashboard.layouts.template')

@section('content')
{{-- TITLE --}}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-2">
  <h1 class="h2">Edit Post</h1>
</div>   

{{-- FORM --}}
<div class="col-lg-8">
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
      @csrf
      @method('put')
      {{-- jika edit methodnya harus PUT/PATCH --}}
      <div class="mb-3">

        {{-- TITLE --}}
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required autofocus> {{-- menambah $post->title agar jika tidak ada post('title'), maka title dari post yang akan ditampilkan --}}
        @error('title')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror
      </div>

      {{-- SLUG (terisi otomatis) --}}
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" required> 
        @error('slug')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror
      </div>

      {{-- CATEGORY --}}
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
            @if (old('category_id', $post->category_id) == $category->id) {{-- untuk menyimpan value old dari sebelumnya --}}
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
          @endforeach
        </select>
      </div>

      {{-- INPUT PHOTO --}}
      <div class="mb-3">
        <label for="image" class="form-label">Post Image</label>

        @if ($post->image)  {{-- agar langsung tampil gambar --}}
        <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-3 col-sm-3 d-block">
        @else  
        <img class="img-preview img-fluid mb-3 col-sm-3">
        @endif

        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
          <div class="invalid-feedback">
            {{ $message }}   
          </div> 
        @enderror
      </div>

      {{-- BODY --}}
      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body"></trix-editor>
        @error('body')
          <p class="text-danger"> {{ $message }}</p>
        @enderror
      </div>
      
      <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

<script>
  // AGAR KETIKA MENULISKAN TITLE, SLUGNYA OTOMATIS TERISI
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function() {
    fetch('/dashboard/posts/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });

  // AGAR MEMILIKI TRIX EDITOR UNTUK MENGISI BODY
  document.addEventListener('trix-file-accept', function(e) {
    e.preventDefault();
  })

  // MEMUNCULKAN PREVIEW IMAGE
  function previewImage() 
  {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(OFREvent)
    {
      imgPreview.src = OFREvent.target.result;
    }
  }
</script>

@endsection