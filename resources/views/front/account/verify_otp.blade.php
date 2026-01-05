@extends('front.layout.master')

@section('title', 'Verify OTP')

@section('body')

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <span>Xác thực OTP</span>
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
                        <h2>Nhập Mã Xác Nhận</h2>
                        <p>Mã OTP đã được gửi đến số: <strong>{{ $phone }}</strong></p>

                        @if(session('notification'))
                            <div class="alert alert-info" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif

                        <form action="{{ route('login.check_otp') }}" method="post">
                            @csrf
                            <input type="hidden" name="phone" value="{{ $phone }}">

                            <div class="group-input">
                                <label for="otp">Mã OTP (6 số) *</label>
                                <input type="text" id="otp" name="otp" placeholder="Nhập mã 6 số..." required>
                            </div>
                            
                            <button type="submit" class="site-btn login-btn">Xác nhận</button>
                        </form>

                        <div class="switch-login">
                            <a href="{{ route('login.phone') }}" class="or-login">Gửi lại mã?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection