@extends('main.master')
@section('title', 'Cash Report')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title -->
        <div class="row page-titles mb-3">
            <div class="col">
                <h4>Cash Transaction Report</h4>
            </div>
            <div class="col text-end">
                {{-- Optional buttons or filters can go here --}}
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <strong>All Transactions</strong>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Account</th>
                            <th>Transaction No</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Date</th>
                            <th>Order No</th>
                            <th>Client</th>
                            <th>Product</th>
                            <th>Billing Cycle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $index => $trx)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $trx->paymentAccount->name ?? 'N/A' }}</td>
                                <td>{{ $trx->transaction_number }}</td>
                                <td>{{ ucfirst($trx->type) }}</td>
                                <td>${{ number_format($trx->amount, 2) }}</td>
                                <td>{{ $trx->notes }}</td>
                                <td>{{ $trx->created_at->format('d M Y') }}</td>
                                <td>{{ $trx->order->order_number ?? 'N/A' }}</td>
                                <td>{{ $trx->order->client->name ?? 'N/A' }}</td>
                                <td>{{ $trx->order->product->name ?? 'N/A' }}</td>
                                <td>{{ $trx->order->billingCycle->cycle_name ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No data available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
