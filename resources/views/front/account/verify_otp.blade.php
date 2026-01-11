@extends('front.layout.master')

@section('title', 'Verify OTP')

@section('body')

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <span>OTP Verification</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Enter OTP</h2>
                        <p>OTP has been sent to number: <strong>{{ $phone }}</strong></p>

                        @if(session('notification'))
                            <div class="alert alert-info" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif

                        <form action="{{ route('login.check_otp') }}" method="post">
                            @csrf
                            <input type="hidden" name="phone" value="{{ $phone }}">

                            <div class="group-input">
                                <label for="otp">OTP Code (6 digits) *</label>
                                <input type="text" id="otp" name="otp" placeholder="Enter 6-digit code..." required>
                            </div>

                            <button type="submit" class="site-btn login-btn">Verify</button>
                        </form>

                        <div class="switch-login">
                            <a href="{{ route('login.phone') }}" class="or-login">Didn't receive OTP? Resend</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection