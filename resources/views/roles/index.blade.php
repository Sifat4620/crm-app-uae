@extends('main.master')

@section('title', 'Roles')


@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col p-0">
                    <h4>Roles</h4>
                </div>
                <div class="col p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>

            <!-- Roles Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Roles</h4>
                            @can(\App\Enum\Permissions::RoleCreate)
                                <a href="{{ route('roles.create') }}" class="btn btn-primary">Add New Role</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        @canany([\App\Enum\Permissions::RoleEdit, \App\Enum\Permissions::RoleDelete])
                                            <th>Actions</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $permissions)
                                                    <span class="btn btn-sm"
                                                        style="background-color: #007bff; color: #fff;">
                                                        {{ $permissions->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            @canany([\App\Enum\Permissions::RoleEdit, \App\Enum\Permissions::RoleDelete])
                                                <td>
                                                    @can(\App\Enum\Permissions::RoleEdit)
                                                        <a href="{{ route('roles.edit', $role) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    @can(\App\Enum\Permissions::RoleDelete)
                                                        <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                            class="d-inline"
                                                            onsubmit="return confirm('Do you really want to delete this?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            @endcanany
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Roles Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
