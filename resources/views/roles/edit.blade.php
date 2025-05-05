<!-- resources/views/products/categories/create.blade.php -->
@extends('main.master')

@section('title', 'Edit Role')

@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col p-0">
                    <h4>Edit Role</h4>
                </div>
                <div class="col p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
                    </ol>
                </div>
            </div>

            <!-- Create Category Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Edit Role</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.update', $role) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}"
                                        required placeholder="Admin">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save Category</button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
