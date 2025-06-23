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
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Clients List</h4>
                            @can(\App\Enum\Permissions::ClientCreate)
                                <a href="{{ route('user.register') }}" class="btn btn-primary">Add Client</a>
                            @endcan
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                @php
                                    // Define colors for statuses (Bootstrap badge colors)
                                    $statusColors = [
                                        'active' => 'success',    // green
                                        'pending' => 'warning',   // yellow
                                        'inactive' => 'secondary', // gray
                                        'cancelled' => 'danger',  // red
                                        // Add other statuses as needed
                                    ];

                                    // Get current selected status from query parameters
                                    $currentStatus = request()->get('status');
                                @endphp

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
                                            <th>Action</th> {{-- New Column --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($clients as $index => $client)
                                            @php
                                                $ordersCount = $client->orders->count();
                                                $totalQuantity = $client->orders->sum('quantity');
                                                $totalSpending = $client->orders->sum('total_price');
                                                $productNames = $client->orders
                                                    ->pluck('product.name')
                                                    ->unique()
                                                    ->filter()
                                                    ->implode(', ');
                                                $statuses = $client->orders->pluck('status')->unique()->implode(', ');
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

                                                {{-- Colored Status Badges --}}
                                                <td>
                                                    @foreach(explode(', ', $statuses) as $status)
                                                        @php
                                                            $color = $statusColors[strtolower($status)] ?? 'primary';
                                                        @endphp
                                                        <span class="badge bg-{{ $color }}">{{ ucfirst($status) }}</span>
                                                    @endforeach
                                                </td>

                                                {{-- Action Buttons with Highlight --}}
                                                <td>
                                                    @foreach ($orderStatuses as $status)
                                                        @php
                                                            $btnClass = (strtolower($currentStatus) == strtolower($status->status_name))
                                                                ? 'btn btn-sm btn-primary me-1 mb-1'  // highlighted
                                                                : 'btn btn-sm btn-outline-primary me-1 mb-1';  // default
                                                        @endphp
                                                        <a href="{{ route('orders.status', ['status' => $status->status_name, 'client' => $client->id]) }}"
                                                            class="{{ $btnClass }}">
                                                            {{ ucfirst($status->status_name) }}
                                                        </a>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">No clients with orders found.</td>
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
