@extends('main.master')

@section('title', 'Profile')

@section('content')
    <div class="content-body">
        <div class="container">

            <!-- Page Title & Breadcrumb -->
            <div class="row page-titles">
                <div class="col p-0">
                    <h4>Profile</h4>
                </div>
                <div class="col p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="post">
                                @csrf
                                @method('patch')

                                <div class="row">
                                    <div class="col-md-6">
                                        @php
                                            $user = auth()->user();
                                            $client = $user->getClient();
                                        @endphp
                                        <!-- Name Input -->
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Name"
                                                value="{{ old('name', $user->name) }}" autofocus autocomplete="username">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Business Name Input -->
                                        <div class="form-group">
                                            <label for="business_name">Business Name</label>
                                            <input type="text"
                                                class="form-control @error('business_name') is-invalid @enderror"
                                                id="business_name" name="business_name" placeholder="Business Name"
                                                value="{{ old('business_name', $client->business_name) }}">
                                            @error('business_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Vat no Input -->
                                        <div class="form-group">
                                            <label for="vat_no">Vat no</label>
                                            <input type="text" class="form-control @error('vat_no') is-invalid @enderror"
                                                id="vat_no" name="vat_no" placeholder="Vat no"
                                                value="{{ old('vat_no', $client->vat_no) }}">
                                            @error('vat_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Tax no Input -->
                                        <div class="form-group">
                                            <label for="tax_no">Tax no</label>
                                            <input type="text" class="form-control @error('tax_no') is-invalid @enderror"
                                                id="tax_no" name="tax_no" placeholder="tax no"
                                                value="{{ old('tax_no', $client->tax_no) }}">
                                            @error('tax_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- National Id Input -->
                                        <div class="form-group">
                                            <label for="national_id">National Id *</label>
                                            <input type="text"
                                                class="form-control @error('national_id') is-invalid @enderror"
                                                id="national_id" name="national_id" placeholder="National Id"
                                                value="{{ old('national_id', $client->national_id) }}">
                                            @error('national_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Phone Input -->
                                        <div class="form-group">
                                            <label for="phone">phone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone" placeholder="Phone"
                                                value="{{ old('phone', $client->phone) }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Business Number Input -->
                                        <div class="form-group">
                                            <label for="business_number">Business Number *</label>
                                            <input type="text"
                                                class="form-control @error('business_number') is-invalid @enderror"
                                                id="business_number" name="business_number" placeholder="Business Number"
                                                value="{{ old('business_number', $client->business_number) }}">
                                            @error('business_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Telephone Input -->
                                        <div class="form-group">
                                            <label for="telephone">Telephone</label>
                                            <input type="text"
                                                class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                                                name="telephone" placeholder="Telephone"
                                                value="{{ old('telephone', $client->telephone) }}">
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Gender Input -->
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <br>
                                            <input type="radio" name="gender" id="male" value="male"
                                                {{ old('gender', $client->gender) == 'male' ? 'checked' : '' }}>
                                            <label for="male">Male</label>
                                            <input type="radio" name="gender" id="female" value="female"
                                                {{ old('gender', $client->gender) == 'female' ? 'checked' : '' }}>
                                            <label for="female">Female</label>
                                        </div>

                                        <!-- Country Input -->
                                        <div class="form-group">
                                            <label for="country">Country *</label>
                                            <input type="text"
                                                class="form-control @error('country') is-invalid @enderror" id="country"
                                                name="country" placeholder="Country"
                                                value="{{ old('country', $client->country) }}">
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- State Input -->
                                        <div class="form-group">
                                            <label for="state">State *</label>
                                            <input type="text"
                                                class="form-control @error('state') is-invalid @enderror" id="state"
                                                name="state" placeholder="State"
                                                value="{{ old('state', $client->state) }}">
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <!-- City Input -->
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <input type="text"
                                                class="form-control @error('city') is-invalid @enderror" id="city"
                                                name="city" placeholder="City"
                                                value="{{ old('city', $client->city) }}">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Zip Input -->
                                        <div class="form-group">
                                            <label for="zip">Zip *</label>
                                            <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                                id="zip" name="zip" placeholder="Zip"
                                                value="{{ old('zip', $client->zip) }}">
                                            @error('zip')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Area Input -->
                                        <div class="form-group">
                                            <label for="area">Area</label>
                                            <input type="text"
                                                class="form-control @error('area') is-invalid @enderror" id="area"
                                                name="area" placeholder="Area"
                                                value="{{ old('area', $client->area) }}">
                                            @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- House Input -->
                                        <div class="form-group">
                                            <label for="house">House</label>
                                            <input type="text"
                                                class="form-control @error('house') is-invalid @enderror" id="house"
                                                name="house" placeholder="House"
                                                value="{{ old('house', $client->house) }}">
                                            @error('house')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Whatsapp Input -->
                                        <div class="form-group">
                                            <label for="whatsapp">Whatsapp</label>
                                            <input type="text"
                                                class="form-control @error('whatsapp') is-invalid @enderror"
                                                id="whatsapp" name="whatsapp" placeholder="Whatsapp"
                                                value="{{ old('whatsapp', $client->whatsapp) }}">
                                            @error('whatsapp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Vibre Input -->
                                        <div class="form-group">
                                            <label for="vibre">Vibre</label>
                                            <input type="text"
                                                class="form-control @error('vibre') is-invalid @enderror" id="vibre"
                                                name="vibre" placeholder="vibre"
                                                value="{{ old('vibre', $client->vibre) }}">
                                            @error('vibre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Imo Input -->
                                        <div class="form-group">
                                            <label for="imo">Imo</label>
                                            <input type="text" class="form-control @error('imo') is-invalid @enderror"
                                                id="imo" name="imo" placeholder="imo"
                                                value="{{ old('imo', $client->imo) }}">
                                            @error('imo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Website Input -->
                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input type="url"
                                                class="form-control @error('website') is-invalid @enderror"
                                                id="website" name="website" placeholder="website"
                                                value="{{ old('website', $client->website) }}">
                                            @error('website')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Notes Input -->
                                        <div class="form-group">
                                            <label for="notes">Notes</label>
                                            <textarea type="url" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes"
                                                placeholder="Notes">{{ old('notes', $client->notes) }}</textarea>
                                            @error('notes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Admin Notes Input -->
                                        <div class="form-group">
                                            <label for="admin_notes">Admin Notes</label>
                                            <textarea type="url" class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes"
                                                name="admin_notes" placeholder="Admin Notes">{{ old('admin_notes', $client->admin_notes) }}</textarea>
                                            @error('admin_notes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Email Address Input -->
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" placeholder="Email"
                                                value="{{ old('email', $user->email) }}" required autocomplete="username"
                                                disabled>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group" style="margin-left: 1rem;">
                                        <input type="submit" value="Save Changes" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
