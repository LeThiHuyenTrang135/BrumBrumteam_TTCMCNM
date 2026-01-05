@extends('front.layout.master')

@section('title', 'Login')


@section('body')


    <!--Thân -->
    <!-- Breadcrumb section begin-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text"> <!--phan duong dan trang-->
                        <a href="index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Breadcrumb section end-->

    <!-- Login Section Begin-->
    <div class="login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>

                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif



                        <form action="" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="email">Email address *</label>
                                <input type="email" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="pass" name="password">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass" name="remember">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Login</button>
                        </form>
                        <div class="switch-login">
                            <a href="./account/register" class="or-login">Or Create An Account</a>

                            <div class="mt-3">
                                <p>Or login with:</p>
                                <a href="{{ route('login.google') }}" class="site-btn"
                                    style="background-color: #DB4437; color: white; width: 100%; display: block; margin-bottom: 10px; text-align: center;">
                                    <i class="fa fa-google"></i> Google
                                </a>
                                <a href="{{ route('login.github') }}" class="site-btn"
                                    style="background-color: #ac1fe4ff; color: white; width: 100%; display: block; margin-bottom: 10px; text-align: center;">
                                    <i class="fa fa-github"></i> Github
                                </a>
                                <a href="{{ route('login.phone') }}" class="site-btn"
                                    style="background-color: #28a745; color: white; width: 100%; display: block; text-align: center;">
                                    <i class="fa fa-phone"></i> Login with SMS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section End-->

@endsection