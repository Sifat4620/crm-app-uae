<!-- resources/views/products/categories/create.blade.php -->
@extends('main.master')

@section('title', 'Edit Role')

@section('content')
    <style>
        input[type=checkbox]:checked+label {
            background-color: #007bff;
            color: white;
        }

        input[type=checkbox]+label:hover {
            background-color: #007bff !important;
            color: white;
        }
    </style>
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

            <!-- Update Role Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Edit Role of {{ $user->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.assign_role_to_user', $user) }}" method="POST">
                                @csrf
                                @method('patch')

                                <div class="form-group">
                                    <label for="name">Assign Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">No Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save User</button>
                                    <a href="{{ route('roles.users') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
