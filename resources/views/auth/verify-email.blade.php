@extends('main.master')

@section('title', 'Verify Email')

@section('content')
    <div class="content-body">
        <div class="container">
            <!-- Create Category Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Verify your Email</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4" style="color: green;">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            @if (session('status') == 'something-went-wrong')
                                <div class="mb-4" style="color: red;">
                                    {{ __('Something went wrong. Could not send email.') }}
                                </div>
                            @endif

                            <div class="mt-4 flex items-center justify-between">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf

                                    <div>
                                        <input type="submit" value="Resend Verification Email" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
