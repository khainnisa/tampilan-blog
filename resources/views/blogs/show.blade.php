@extends('layouts.main')

@section('title', $blog->title)

@section('styles')
    <style>
        .header-title {
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="header-title mt-5">
            <h1>Edit Blog - {{$blog->title}}</h1>
        </div>
        <p>{{ $blog->content }}</p>
        <p><strong>Category:</strong> {{ $blog->category->name }}</p>

        {{-- tombol kembali --}}
        <a href="/blogs" class="btn btn-secondary">Back</a>
    </div>
@endsection