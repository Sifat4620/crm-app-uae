@extends('main.master')

@section('title', 'Record Payment')

@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col">
                    <h4>Record Payment</h4>
                </div>
            </div>

            <!-- Record Payment Form -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4 class="card-title">New Payment</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('payments.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="client_id">Client</label>
                                    <select name="client_id" id="client_id" class="form-control" required>
                                        <option value="">Select Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="method">Payment Method</label>
                                    <select name="method" id="method" class="form-control" required>
                                        <option value="">Select Method</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="card">Card</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="note">Note (optional)</label>
                                    <textarea name="note" id="note" rows="3" class="form-control"></textarea>
                                </div>

                                <div class="form-group mt-4 text-end">
                                    <button type="submit" class="btn btn-success">Submit Payment</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
