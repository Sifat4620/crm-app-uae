<!-- resources/views/products/categories/create.blade.php -->
@extends('main.master')

@section('content')
    <div class="content-body">
        <div class="container">

            {{-- <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col p-0">
                    <h4>Create New Category</h4>
                </div>
                <div class="col p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Create Category</li>
                    </ol>
                </div>
            </div> --}}

            <!-- Create Category Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.categories.update', $category) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save Category</button>
                                    <a href="{{ route('products.categories.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
