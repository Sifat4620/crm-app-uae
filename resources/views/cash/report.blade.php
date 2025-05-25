@extends('main.master')

@section('title', 'Cash Report')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>Cash Report</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Summary</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Cash In</span>
                                <strong>{{ number_format($cashIn, 2) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Cash Out</span>
                                <strong>{{ number_format($cashOut, 2) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Balance</span>
                                <strong>{{ number_format($cashIn - $cashOut, 2) }}</strong>
                            </li>
                        </ul>

                        <h5 class="mb-3">Recent Transactions</h5>
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
                                    <tr><td colspan="5" class="text-center">No records found.</td></tr>
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
