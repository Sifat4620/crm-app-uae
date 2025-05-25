@extends('main.master')

@section('title', 'Payment Report')

@section('content')
<div class="content-body">
    <div class="container">
        <!-- Page Title -->
        <div class="row page-titles">
            <div class="col">
                <h4>Payment Report</h4>
            </div>
        </div>

        <!-- Filter Form (optional) -->
        <div class="row mb-3">
            <div class="col-lg-12">
                <form method="GET" action="{{ route('payments.report') }}" class="form-inline">
                    <input type="date" name="from" class="form-control me-2" placeholder="From Date">
                    <input type="date" name="to" class="form-control me-2" placeholder="To Date">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </form>
            </div>
        </div>

        <!-- Report Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Payments Summary</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Invoice</th>
                                    <th>Amount</th>
                                    <th>Gateway</th>
                                    <th>Status</th>
                                    <th>Paid At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $payment->client->user->name ?? 'N/A' }}</td>
                                        <td>{{ $payment->invoice->id ?? 'N/A' }}</td>
                                        <td>{{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->gateway->name ?? 'Manual' }}</td>
                                        <td>{{ ucfirst($payment->status) }}</td>
                                        <td>{{ $payment->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No payments found.</td>
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
