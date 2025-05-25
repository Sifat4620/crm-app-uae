@extends('main.master')

@section('title', 'Payment Accounts')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>Payment Accounts</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">All Accounts</h4>
                        <a href="{{ route('payment-accounts.create') }}" class="btn btn-primary">Add Account</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Gateway</th>
                                    <th>Account Number</th>
                                    <th>Holder Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($accounts as $index => $account)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $account->gateway->name ?? 'N/A' }}</td>
                                        <td>{{ $account->account_number }}</td>
                                        <td>{{ $account->account_holder }}</td>
                                        <td>{{ $account->status }}</td>
                                        <td>
                                            <a href="{{ route('payment-accounts.edit', $account->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('payment-accounts.destroy', $account->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this account?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">No accounts found.</td></tr>
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
