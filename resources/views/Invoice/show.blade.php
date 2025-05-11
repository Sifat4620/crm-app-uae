@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">

        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles">
            <div class="col">
                <h4>Invoice Details</h4>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="row">
            <div class="col-lg-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Invoice #{{ $invoice->id }}</h5>
                        <p><strong>Customer Name:</strong> {{ $invoice->customer_name ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
                        <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>
                        <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>

                        <!-- Download Button -->
                        <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-primary">Download PDF</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
