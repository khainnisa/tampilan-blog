@extends('layouts.main')

@section('title', 'Create Category')

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
        <h1>Create a New Category</h1>
    </div>
    <form action="category.store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <a href="category.index" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
@endsection