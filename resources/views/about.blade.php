@extends('layouts/template')

@section('content')
    <h1>{{ $title }}</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="150px">
@endsection

