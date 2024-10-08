@extends('layouts.main')
@section('title', 'Blog')

@section('styles')
    <style>
        .custom-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="header-title">
                    <h1>Blog</h1>
                </div>
                {{-- tombol tambah --}}
                <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Create New Blog</a>

                {{-- tombol arahin ke category --}}
                <a href="/category" class="btn btn-secondary mb-3"></i> Categories</a>
                {{-- pencarian dan filter --}}
                <form action="/blogs " method="GET">
                    <div class="input-group mb-3">
                        {{-- filter berdasarkan kategori --}}
                        <select name="category" class="form-select" id="category">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" {{ request()->get('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- form percarian --}}
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->get('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 custom-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->judul }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $blog->category->name }}</h6>
                                    <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                                </div>
                                <div class="card-footer">
                                    {{-- Tombol edit --}}
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>

                                                                     
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $blog->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    
                                    {{-- Modal konfirmasi delete --}}
                                    <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $blog->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $blog->id }}">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this blog post?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                 
                                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Tombol lihat --}}
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
