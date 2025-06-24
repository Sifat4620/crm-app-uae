@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles mb-3">
            <div class="col">
                <h4>Invoices</h4>
            </div>
            <div class="col text-end">
                <a href="{{ route('invoice.create') }}" class="btn btn-primary">Create New Invoice</a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Invoices Table -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Billing Cycle</th> {{-- ✅ New Column --}}
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $index => $invoice)
                            <tr>
                                <td>{{ ($invoices->currentPage() - 1) * $invoices->perPage() + $index + 1 }}</td>
                                <td>{{ $invoice->customer_name }}</td>
                                <td>${{ number_format($invoice->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ match($invoice->status) {
                                        'paid' => 'success',
                                        'due' => 'warning',
                                        'overdue' => 'danger',
                                        'canceled' => 'secondary',
                                        'refunded' => 'info',
                                        default => 'dark'
                                    } }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $invoice->billing_cycle_id ?? 'N/A' }}
                                    {{-- Replace with $invoice->billingCycle->name if using a relation --}}
                                </td>
                                <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('invoice.show', $invoice) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('invoice.edit', $invoice) }}" class="btn btn-sm btn-warning">Edit</a>
                                    {{-- <a href="{{ route('invoice.download', $invoice) }}" class="btn btn-sm btn-primary">PDF</a> --}}
                                    <form action="{{ route('invoice.destroy', $invoice) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No invoices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-3">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
