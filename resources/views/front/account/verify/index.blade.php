@extends('front.layout.master')

@section('body')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Verify Your Email Address</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('notification'))
                            <div class="alert alert-info">
                                {!! session('notification') !!}
                            </div>
                        @endif

                        @php
                            $email = $email ?? old('email');
                            $parts = explode('@', $email);
                            $name = $parts[0];
                            $domain = $parts[1] ?? '';
                            $maskedName = str_repeat('*', max(0, strlen($name) - 2)) . substr($name, -2);
                            $maskedEmail = $maskedName . '@' . $domain;
                        @endphp

                        <p class="text-muted">We've sent a 6-digit verification code to
                            <strong>{{ $maskedEmail }}</strong>. Please enter the code to verify your email
                            address.
                        </p>

                        <form method="POST" action="{{ route('verify') }}">
                            @csrf

                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="mb-3">
                                <label for="code" class="form-label">Verification Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" maxlength="6" required placeholder="Enter 6-digit code">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Verify Email</button>
                                <a href="{{ route('login') }}" class="btn btn-link">Back to Login</a>
                            </div>
                        </form>

                        <div class="mt-4 text-center">
                            <p>Didn't receive the code?</p>
                            <form method="POST" action="{{ route('resend.code') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <button type="submit" class="btn btn-outline-secondary">Resend Verification Code</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
