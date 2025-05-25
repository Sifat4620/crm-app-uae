@extends('main.master')

@section('title', 'My Orders - Make Payment')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>My Orders</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Orders</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->product->name ?? 'N/A' }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                                @if($order->has_paid)
                                                    <span class="badge badge-success">Payment Complete</span>
                                                @elseif(!in_array($order->status, ['Canceled', 'Terminated']))
                                                    <a href="{{ route('payments.create', ['order_id' => $order->id]) }}" class="btn btn-sm btn-primary">Pay</a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
