@extends('main.master')

@section('title', 'Create client')

@section('content')
    <div class="content-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Create Clients</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- National ID -->
                                <div class="form-group">
                                    <label for="national_id">National ID *</label>
                                    <input type="text" name="national_id"
                                        class="form-control @error('national_id') is-invalid @enderror"
                                        value="{{ old('national_id') }}" >
                                    @error('national_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Business Number -->
                                <div class="form-group">
                                    <label for="business_number">Business Number *</label>
                                    <input type="text" name="business_number"
                                        class="form-control @error('business_number') is-invalid @enderror"
                                        value="{{ old('business_number') }}" >
                                    @error('business_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="form-group">
                                    <label>Gender</label>
                                    <br>
                                    <input type="radio" name="gender" value="male" id="male">
                                    <label for="male" style="cursor: pointer;">Male</label>
                                    <input type="radio" name="gender" value="female" id="female">
                                    <label for="female" style="cursor: pointer;">Female</label>
                                </div>

                                <!-- Country -->
                                <div class="form-group">
                                    <label for="country">Country *</label>
                                    <input type="text" name="country"
                                        class="form-control @error('country') is-invalid @enderror"
                                        value="{{ old('country') }}" >
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state"
                                        class="form-control @error('state') is-invalid @enderror"
                                        value="{{ old('state') }}" >
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city') }}" >
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Zip -->
                                <div class="form-group">
                                    <label for="zip">Zip</label>
                                    <input type="text" name="zip"
                                        class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip') }}"
                                        >
                                    @error('zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" >
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation *</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') }}" >
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Submit Button -->
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Create Client</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
