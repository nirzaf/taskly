@extends('layouts.auth')

@section('content')


    <!-- email send icon with text-->
    <div class="text-center m-auto">
        <img src="{{ asset('images/mail_sent.svg') }}" alt="mail sent image" height="64" />
        <h4 class="text-dark-50 text-center mt-4 font-weight-bold">{{ __('Please check your email') }}</h4>
        <p class="text-muted mb-4">

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
        {{ __('Please check for an email from company and click on the included link to reset your password.') }}
        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </p>
</div>

<!-- form -->
<form action="{{ route('login') }}">
    <div class="form-group mb-0 text-center">
        <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-home mr-1"></i> {{ __('Back to Home') }} </button>
    </div>
</form>
<!-- end form-->
@endsection
