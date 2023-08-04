@extends('layouts.auth')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <h4 style="font-size: 1.3em; font-weight:600;" class="text-center pt-3">Register</h4>
                    <hr>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Your Full Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>


                            <div class="form-group text-center">
                                <span>
                                    have an account? <a href="{{ route('login') }}"
                                        style="color: rgb(26, 117, 255);">Login</a>
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
    </div>
@endsection
