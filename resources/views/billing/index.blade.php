@extends('main.master')

@section('content')
    <div class="content-body">
        <div class="container">
            {{-- 
            <!-- Page Title -->
            <div class="row page-titles">
                <div class="col">
                    <h4>Billing Cycles</h4>
                </div>
                <div class="col text-end">
                    <a href="{{ route('billing-cycles.create') }}" class="btn btn-primary">+ Add New</a>
                </div>
            </div> --}}

            <!-- Table -->
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Billing Cycle</h4>
                            @can(\App\Enum\Permissions::BillingCycleCreate)
                                <a href="{{ route('billing-cycles.create') }}" class="btn btn-primary"> + Add New</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Cycle Name</th>
                                        <th>Duration (Days)</th>
                                        <th>Created At</th>
                                        @canany([\App\Enum\Permissions::BillingCycleEdit,
                                            \App\Enum\Permissions::BillingCycleDelete])
                                            <th>Actions</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cycles as $index => $cycle)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $cycle->cycle_name }}</td>
                                            <td>{{ $cycle->duration_in_days }}</td>
                                            <td>{{ $cycle->created_at->format('d M Y') }}</td>
                                            @canany([\App\Enum\Permissions::BillingCycleEdit,
                                                \App\Enum\Permissions::BillingCycleDelete])
                                                <td>
                                                    @can(\App\Enum\Permissions::BillingCycleEdit)
                                                        <a href="{{ route('billing-cycles.edit', $cycle->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                    @endcan
                                                    @can(\App\Enum\Permissions::BillingCycleDelete)
                                                        <form action="{{ route('billing-cycles.destroy', $cycle->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            @endcanany
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No billing cycles found.</td>
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
