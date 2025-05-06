@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col">
                <h4>Ticket Details</h4>
            </div>
            <div class="col text-end">
                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to Tickets</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">{{ $ticket->title }}</h5>
                <small class="text-muted">Status: 
                    <span class="badge bg-{{ $ticket->status == 'open' ? 'success' : 'secondary' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                    | Priority: 
                    <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'normal' ? 'info' : 'secondary') }}">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                </small>
            </div>

            <div class="card-body">
                <p><strong>Created At:</strong> {{ $ticket->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $ticket->message }}</p>
            </div>
        </div>

        <!-- Messages Section -->
        @if($ticket->messages->count())
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h6 class="mb-0">Conversation</h6>
            </div>
            <div class="card-body">
                @foreach($ticket->messages as $message)
                    <div class="mb-3 p-3 border rounded 
                        {{ $message->user_id == auth()->id() ? 'bg-light' : 'bg-white' }}">
                        <p class="mb-1"><strong>{{ $message->user->name ?? 'User' }}</strong></p>
                        <p class="mb-1">{{ $message->message }}</p>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
