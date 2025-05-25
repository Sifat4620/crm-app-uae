@extends('main.master')
@section('title', 'New Cash Transaction')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title -->
        <div class="row page-titles">
            <div class="col">
                <h4>Add New Transaction</h4>
            </div>
            <div class="col text-end">
                {{-- Optional action button or breadcrumbs here --}}
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('cash-transactions.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="payment_account_id" class="form-label">Account</label>
                        <select id="payment_account_id" name="payment_account_id" class="form-control" required>
                            <option value="" disabled {{ old('payment_account_id') ? '' : 'selected' }}>-- Select Account --</option>
                            @foreach ($accounts as $id => $name)
                                <option value="{{ $id }}" {{ old('payment_account_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            id="amount"
                            class="form-control"
                            value="{{ old('amount') }}"
                            required
                            placeholder="Enter amount"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Select Type --</option>
                            <option value="deposit" {{ old('type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                            <option value="withdraw" {{ old('type') == 'withdraw' ? 'selected' : '' }}>Withdraw</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea
                            id="notes"
                            name="notes"
                            class="form-control"
                            rows="3"
                            placeholder="Optional notes"
                        >{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Record Transaction</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
