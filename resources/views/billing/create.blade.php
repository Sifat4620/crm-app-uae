@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col">
                <h4>Add Billing Cycle</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('billing-cycles.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="cycle_name" class="form-label">Cycle Name</label>
                                <input type="text" name="cycle_name" class="form-control" value="{{ old('cycle_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="duration_in_days" class="form-label">Duration (Days)</label>
                                <input type="number" name="duration_in_days" class="form-control" value="{{ old('duration_in_days') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('billing-cycles.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
