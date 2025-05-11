@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles">
            <div class="col">
                <h4>Invoices</h4>
            </div>
        </div>

        <!-- Invoices Table -->
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
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $index => $invoice)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $invoice->customer_name }}</td>
                                        <td>${{ number_format($invoice->amount, 2) }}</td>
                                        <td>{{ ucfirst($invoice->status) }}</td>
                                        <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('invoice.show', $invoice) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('invoice.edit', $invoice) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('invoices.download', $invoice) }}" class="btn btn-sm btn-primary">PDF</a>
                                            <form action="{{ route('invoice.destroy', $invoice) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No invoices found.</td>
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
