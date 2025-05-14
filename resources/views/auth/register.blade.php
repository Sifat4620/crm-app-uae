<!DOCTYPE html>
<html lang="en" class="h-100" id="login-page1">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/modernizr.3.6.0.min.js') }}"></script>
</head>

<body class="h-100">
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-input-content">
                        <div class="card">
                            <div class="card-body">
                                <!-- Logo Section -->
                                <div class="logo text-center mt-4">
                                    <h4>CRM - Customer Relationship Management System</h4>
                                </div>

                                <!-- Login Form Heading -->
                                <h4 class="text-center mt-3">Create Your Account</h4>

                                <!-- Form Starts Here -->
                                <form class="m-t-30 m-b-30" method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name Input -->
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Name" value="{{ old('name') }}"
                                            autofocus autocomplete="username">
                                        @error('name')
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
                                            value="{{ old('national_id') }}">
                                        @error('national_id')
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
                                            value="{{ old('business_number') }}">
                                        @error('business_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Gender Input -->
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <br>
                                        <label for="male">Male</label>
                                        <input type="radio" name="gender" id="male" value="male">
                                        <label for="female">Female</label>
                                        <input type="radio" name="gender" id="female" value="female">
                                    </div>

                                    <!-- Country Input -->
                                    <div class="form-group">
                                        <label for="country">Country *</label>
                                        <input type="text"
                                            class="form-control @error('country') is-invalid @enderror" id="country"
                                            name="country" placeholder="Country" value="{{ old('country') }}">
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
                                            name="state" placeholder="State" value="{{ old('state') }}">
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- City Input -->
                                    <div class="form-group">
                                        <label for="city">City *</label>
                                        <input type="text"
                                            class="form-control @error('city') is-invalid @enderror" id="city"
                                            name="city" placeholder="City" value="{{ old('city') }}">
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
                                            value="{{ old('zip') }}">
                                        @error('zip')
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
                                            name="email" placeholder="Email" value="{{ old('email') }}" required
                                            autocomplete="username">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password Input -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password Input -->
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Password Confirmation">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center m-b-15 m-t-15">
                                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                                    </div>
                                </form>
                                <!-- Form Ends Here -->

                                <!-- Alternative Login Options (Social Media or Others) -->
                                <div class="text-center">
                                    <p class="m-t-30">Already have an account? <a href="{{ route('login') }}">Login
                                            Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Common JS -->
    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/custom.mini.nav.js') }}"></script>
</body>

</html>
