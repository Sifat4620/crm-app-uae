@extends('main.master')

@section('title', 'Payment Gateways')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>Payment Gateways</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">All Payment Gateways</h4>
                        <a href="{{ route('payment-gateways.create') }}" class="btn btn-primary">Add Gateway</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gateways as $index => $gateway)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $gateway->name }}</td>
                                        <td>{{ $gateway->type }}</td>
                                        <td>{{ $gateway->status }}</td>
                                        <td>
                                            <a href="{{ route('payment-gateways.edit', $gateway->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('payment-gateways.destroy', $gateway->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this gateway?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">No gateways found.</td></tr>
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
