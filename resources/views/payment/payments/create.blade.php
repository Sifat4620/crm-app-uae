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
                                <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
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
