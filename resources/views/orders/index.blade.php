@extends('main.master')

@section('title', 'Orders')

@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col">
                    <h4>Orders</h4>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Orders</h4>
                            <a href="{{ route('orders.create') }}" class="btn btn-primary">Create Order</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Client</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Ordered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                                            <td>{{ $order->client->user->name ?? 'N/A' }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No orders found.</td>
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
