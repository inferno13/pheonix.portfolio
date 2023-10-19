@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url("media/welcome/hero2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
        }
    </style>
    <div class="bg-primary-dark-op">
        <div class="hero-static d-flex align-items-center justify-content-center">
            <div class="block block-rounded w-100 overflow-hidden p-3" style="max-width: 450px;">
                <div class="block-content block-content-full">
                    <div class="mb-2 text-center">
                        <a class="fw-bold fs-1" href="{{ route('register') }}">
                            <img src="/media/logos/logo-short.png" class="img-fluid w-50 mb-5">
                        </a>
                        <p class="text-uppercase fw-bold fs-sm text-muted">Регистрация</p>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Электронная почта" required
                                autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="username"
                                name="username" value="" placeholder="Никнейм" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-alt " id="invite_code" name="invite_code"
                                value="" placeholder="Код приглашения (если есть)">
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                placeholder="Пароль" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Подтверждение пароля" required autocomplete="new-password">
                        </div>
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" value="1" id="agreement"
                                    name="agreement">
                                @error('agreement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-check-label" for="agreement">Я согласен/согласна с <a
                                        href="https://pheonix.tech/privacy-policy" target="_blank">политикой
                                        конфиденциальности</a> и <a href="https://pheonix.tech/license-agreement"
                                        target="_blank">лицензионным соглашением</a>.</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn w-100 btn-hero btn-primary">
                                <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Зарегистрироваться
                            </button>
                        </div>
                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1"
                                href="{{ url()->previous() }}">
                                <i class="fa fa-arrow-left opacity-50 me-1"></i> Назад
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const input = document.querySelector('#invite_code')
        const url = new URL(window.location.href)
        input.value = url.searchParams.get('invite_code')
    </script>
@endsection
