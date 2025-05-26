@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col">
                <h4>My Support Tickets</h4>
            </div>
            {{-- <div class="col text-end">
                <a href="{{ route('tickets.create') }}" class="btn btn-primary">Raise New Ticket</a>
            </div> --}}
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $index => $ticket)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>
                                    @if($ticket->priority == 'low')
                                        <span class="badge bg-secondary">Low</span>
                                    @elseif($ticket->priority == 'normal')
                                        <span class="badge bg-info">Normal</span>
                                    @else
                                        <span class="badge bg-danger">High</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->status == 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif($ticket->status == 'closed')
                                        <span class="badge bg-dark">Closed</span>
                                    @else
                                        <span class="badge bg-warning">{{ ucfirst($ticket->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
