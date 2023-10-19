@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url("media/welcome/hero2.jpg") !important;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
        }
    </style>
    <div class="bg-primary-dark-op">
        <div class="hero-static d-flex align-items-center justify-content-center">
            <div class="block block-rounded w-100 overflow-hidden p-3" style="max-width: 450px;">
                <div class="block-content block-content-full">
                    <div class="text-center">
                        <a class="fw-bold fs-1" href="{{ url()->current() }}">
                            <img src="/media/logos/logo-short.png" class="img-fluid w-50 mb-5">
                        </a>
                        <p class="text-uppercase fw-bold fs-sm text-muted">{{ __('Reset Password') }}</p>
                    </div>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" autofocus value="{{ $email ?? old('email') }}"
                                placeholder="Электронная почта" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                value="{{ old('password') }}" placeholder="{{ __('Password') }}" required
                                autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input id="password-confirm" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password_confirmation" value="{{ old('password') }}"
                                placeholder="{{ __('Confirm Password') }}" required autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn w-100 btn-hero btn-primary">
                                <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
