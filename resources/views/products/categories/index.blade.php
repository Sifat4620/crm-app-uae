@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles">
            <div class="col">
                <h4>Product Categories</h4>
            </div>
            <div class="col text-right">
                <a href="{{ route('products.categories.create') }}" class="btn btn-primary">Add New Category</a>
            </div>
        </div>

        <!-- Category Table -->
        <div class="row">
            <div class="col-lg-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('products.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('products.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
