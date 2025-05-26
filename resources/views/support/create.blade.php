@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col">
                {{-- <h4>Raise a New Ticket</h4> --}}
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('tickets.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Ticket Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message / Description</label>
                        <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                                  placeholder="Describe your issue...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
