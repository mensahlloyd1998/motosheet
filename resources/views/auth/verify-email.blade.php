

@extends('layouts.auth')

@section('form-card')
    <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
        <div class="mb-4 text-muted" style="font-size:.875rem; line-height:2;">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-success" style="font-size:.875rem; line-height:2;">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 d-flex align-items-center justify-content-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="btn-dark btn" type="submit">{{ __('Resend Verification Email') }}</button>

            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-muted btn" type="submit">{{ __('Logout') }}</button>

            </form>

        </div>


    </div>
@endsection