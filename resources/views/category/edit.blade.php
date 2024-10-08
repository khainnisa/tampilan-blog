@extends('layouts.main')

@section('title', 'Edit Category - ' . $categories->name)

@section('content')
    <div class="container">
        <div class="header-title mt-5">
            <h1>Edit Category</h1>
        </div>
        <form action="{{ route('category.update', $categories->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                    value="{{ old('name', $categories->name) }}"  
                    required>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $categories->description) }}</textarea>  
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Update</button>

            {{-- tombol back --}}
            <a href="/category" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
