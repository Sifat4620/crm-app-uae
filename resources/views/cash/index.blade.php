@extends('main.master')

@section('title', 'Cash Transactions')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>Cash Transactions</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">All Cash Transactions</h4>
                        <a href="{{ route('cash-transactions.create') }}" class="btn btn-primary">Record Transaction</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $index => $txn)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $txn->type }}</td>
                                        <td>{{ $txn->amount }}</td>
                                        <td>{{ $txn->description }}</td>
                                        <td>{{ $txn->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">No transactions found.</td></tr>
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
