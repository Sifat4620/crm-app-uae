@extends('main.master')

@section('title', 'Payments Report')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>All Payments Report</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Payments</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Order</th>
                                    <th>Client</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($payment->order)
                                                {{ $payment->order->product->name ?? 'N/A' }}<br>
                                                <small class="text-muted">#{{ $payment->order->id }}</small>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $payment->client->name ?? 'N/A' }}</td>
                                        <td>${{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->payment_method }}</td>
                                        <td>
                                            @if($payment->status === 'completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif($payment->status === 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                                        <td>{{ $payment->notes ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No payment records found.</td>
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
