@extends('main.master')

@section('title', $title)


@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col p-0">
                    <h4>{{ $title }}</h4>
                </div>
                <div class="col p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>

            <!-- Roles Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        @if ($title == 'Admin')
                                            <th>Role</th>
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            @if ($title == 'Admin')
                                                <td>{{ $user->roles->first()->name }}</td>
                                            @endif
                                            <td><a href="{{ route('roles.user.edit', $user) }}">Edit</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No {{ $title }} Available</td>
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
