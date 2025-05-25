@extends('main.master')

@section('title', 'Make Payment')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>Make a Payment</h4>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <form action="{{ route('payments.store') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="order_id" value="{{ request('order_id') }}">

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount to Pay</label>
                                <input
                                    type="number"
                                    name="amount"
                                    step="0.01"
                                    min="0.01"
                                    max="{{ number_format(optional($order)->total_price - optional($order)->payments->sum('amount'), 2, '.', '') }}"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    value="{{ old('amount', number_format(optional($order)->total_price - optional($order)->payments->sum('amount'), 2, '.', '')) }}"
                                    required
                                >
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes (optional)</label>
                                <textarea
                                    name="notes"
                                    id="notes"
                                    class="form-control @error('notes') is-invalid @enderror"
                                    rows="3"
                                >{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_account_name" class="form-label">Bank Name / Payment Account</label>
                                <input
                                    type="text"
                                    name="payment_account_name"
                                    id="payment_account_name"
                                    class="form-control @error('payment_account_name') is-invalid @enderror"
                                    value="{{ old('payment_account_name') }}"
                                    required
                                >
                                @error('payment_account_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- New fields for PaymentAccount creation --}}
                            <div class="mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input
                                    type="text"
                                    name="account_number"
                                    id="account_number"
                                    class="form-control @error('account_number') is-invalid @enderror"
                                    value="{{ old('account_number') }}"
                                >
                                @error('account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="holder_name" class="form-label">Account Holder Name</label>
                                <input
                                    type="text"
                                    name="holder_name"
                                    id="holder_name"
                                    class="form-control @error('holder_name') is-invalid @enderror"
                                    value="{{ old('holder_name') }}"
                                >
                                @error('holder_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="branch" class="form-label">Branch</label>
                                <input
                                    type="text"
                                    name="branch"
                                    id="branch"
                                    class="form-control @error('branch') is-invalid @enderror"
                                    value="{{ old('branch') }}"
                                >
                                @error('branch')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="transaction_number" class="form-label">Bank Transaction Number</label>
                                <input
                                    type="text"
                                    name="transaction_number"
                                    id="transaction_number"
                                    class="form-control @error('transaction_number') is-invalid @enderror"
                                    value="{{ old('transaction_number') }}"
                                    required
                                >
                                @error('transaction_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Our Demo Account Info</label>
                                <div class="alert alert-info">
                                    <strong>Account Name:</strong> Demo Company Ltd<br>
                                    <strong>Bank Name:</strong> Demo Bank<br>
                                    <strong>Account Number:</strong> 1234567890<br>
                                    <strong>Branch:</strong> Dhaka Main Branch
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Pay from Wallet</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
