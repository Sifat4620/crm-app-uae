@extends('main.master')

@section('title', 'Cash Transactions')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title -->
        <div class="row page-titles">
            <div class="col">
                <h4>Cash Transactions</h4>
            </div>
            <div class="col text-end">
                {{-- You can add an "Add New" button here if needed --}}
                {{-- <a href="{{ route('cash-transactions.create') }}" class="btn btn-primary">+ Add New</a> --}}
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Transactions Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>Transaction No</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $index => $trx)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $trx->paymentAccount->name ?? 'N/A' }}</td>
                                        <td>{{ $trx->transaction_number }}</td>
                                        <td>{{ ucfirst($trx->type) }}</td>
                                        <td>${{ number_format($trx->amount, 2) }}</td>
                                        <td>{{ $trx->notes }}</td>
                                        <td>{{ $trx->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No transactions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
