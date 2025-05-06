@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col">
                <h4>Backup Management</h4>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Backup Form -->
                <form method="POST" action="{{ route('backup.now') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="backupAction" class="form-label">Trigger a Backup</label>
                        <p class="text-muted">Click the button below to manually trigger a backup of your system.</p>
                    </div>

                    <!-- Backup Button -->
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-backup"></i> Start Backup
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
