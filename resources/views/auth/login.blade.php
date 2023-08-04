@extends('layouts.auth')
@section('title', 'User Login')

@section('content')
    <div class="row justify-content-center" style="margin: 0 0 5rem 0; padding: 5rem 0 0 0;">
        <div class="col-md-4">
            <div class="card">
                <div class="text-center pt-3 display-4">Login Your Account</div>
                <hr>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email"
                                class="form-control pl-3 @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control pl-3 @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-right">
                            @if (Route::has('password.request'))
                                <a class="text-info" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="form-group text-center">
                            <span>
                                If you haven't an account? <a href="{{ route('register') }}"
                                    style="color: rgb(26, 117, 255);">Register</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-primary text-white fw-bold text-center pt-3">
        <div class="col-md-12">
            <h5 style="font-size: 1em; font-weight:500;">Copyright &copy; 2023, All Rights reserved</h5>
        </div>
    </div>
@endsection
