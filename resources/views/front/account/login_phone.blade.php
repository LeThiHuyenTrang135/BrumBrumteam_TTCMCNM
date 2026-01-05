@extends('front.layout.master')

@section('title', 'Login SMS')

@section('body')

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <span>Login SMS</span>
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
                        <h2>Đăng nhập bằng SĐT</h2>

                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif

                        <form action="{{ route('login.send_otp') }}" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="phone">Số điện thoại *</label>
                                <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" required>
                                @error('phone')
                                    <span class="text-danger" style="color: red; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="site-btn login-btn">Gửi mã OTP</button>
                        </form>
                        
                        <div class="switch-login">
                            <a href="./account/login" class="or-login">Quay lại Đăng nhập thường</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection