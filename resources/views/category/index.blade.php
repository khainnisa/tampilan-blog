@extends('layouts.main')

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
            <h1>Categories</h1>
        </div>

        {{-- Tombol buat category --}}
        <a href="/category/create" class="btn btn-primary mb-3">
            <i class="bi bi-plus"></i> Create New Category
        </a>

        {{-- Tabel kategori --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            {{-- Tombol edit --}}
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            
                            {{-- Tombol delete dengan konfirmasi modal --}}
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>

                            {{-- Modal konfirmasi delete --}}
                            <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the category "{{ $category->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tombol kembali --}}
        <a href="/blogs" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
