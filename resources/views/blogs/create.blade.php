@extends('layouts.main')
@section('title', 'Create Blog')

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
        <h1>Create a New Blog Post</h1>
    </div>
    {{-- aksi store --}}
    <form method="post" action="{{ route('blogs.store') }}">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            {{-- perhatikan title di sini awalnya judul --}}
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group my-4">
            <label for="category">Category</label>
            {{-- dan disini --}}
            <select name="category" class="form-select" id="category" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- Tombol back, sesuaiin routes nya--}}
        <a href="/blogs" class="btn btn-secondary">Back</a>
        {{-- submit --}}
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
@endsection