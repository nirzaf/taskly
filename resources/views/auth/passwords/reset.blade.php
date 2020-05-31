@extends('layouts.auth')

@section('content')
    <div class="card card-primary">
    <!-- title-->
        <div class="card-header"><h4>{{ __('Reset Password') }}</h4></div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="emailaddress">{{ __('Email Address') }}</label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="emailaddress" required autocomplete="email" placeholder="{{ __('Enter Your Email') }}" value="{{ $email ?? old('email') }}" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required autocomplete="new-password" id="password" placeholder="{{ __('Enter Your Password') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" required autocomplete="new-password" id="password_confirmation" placeholder="{{ __('Enter Your Password') }}">
                </div>
                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i> {{ __('Reset Password') }} </button>
                </div>
            </form>
        </div>
    </div>
@endsection
