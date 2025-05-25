@extends('main.master')

@section('title', 'Clients & Orders')

@section('content')
<div class="content-body">
    <div class="container">

        <div class="row page-titles">
            <div class="col">
                <h4>Clients & Their Orders</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Clients List</h4>
                        <a href="{{ route('user.register') }}" class="btn btn-primary">Add Client</a>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>Business Name</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Orders Count</th>
                                        <th>Total Quantity</th>
                                        <th>Total Spending</th>
                                        <th>Products</th>
                                        <th>Status</th>
                                        <th>Actions</th> {{-- ✅ New --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($clients as $index => $client)
                                        @php
                                            $orders = $client->orders;
                                            $ordersCount = $orders->count();
                                            $totalQuantity = $orders->sum('quantity');
                                            $totalSpending = $orders->sum('total_price');
                                            $productNames = $orders->pluck('product.name')->unique()->filter()->implode(', ');
                                            $statuses = $orders->pluck('status')->unique()->filter()->implode(', ');
                                        @endphp
                                        <tr>
                                            <td>{{ $clients->firstItem() + $index }}</td>
                                            <td>{{ $client->user->name ?? 'N/A' }}</td>
                                            <td>{{ $client->business_name ?? '-' }}</td>
                                            <td>{{ $client->phone ?? '-' }}</td>
                                            <td>{{ $client->country ?? '-' }}</td>
                                            <td>{{ $ordersCount }}</td>
                                            <td>{{ $totalQuantity }}</td>
                                            <td>${{ number_format($totalSpending, 2) }}</td>
                                            <td>{{ $productNames ?: '-' }}</td>
                                            <td>{{ $statuses ?: '-' }}</td>
                                            <td>
                                                {{-- ✅ Show each order status with count --}}
                                                @foreach($orders->groupBy('status') as $status => $group)
                                                    <span class="badge bg-info text-dark mb-1">
                                                        {{ $status }} ({{ $group->count() }})
                                                    </span><br>
                                                @endforeach

                                                {{-- Optional View Button --}}
                                                <a href="{{ route('orders.byClient', $client->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                    View Orders
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No clients found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $clients->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
