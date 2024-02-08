@extends('layouts.app')
@section('title-name', 'Accedi')

@section('content')
<div class="container-fluid vh-100 login-register-body hamburger" >
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="border-card mt-4">
                <div class="card_header">{{ __('Accedi') }}</div>

                <div class="card-body p-4">
                    <form id="formEl" method="POST" action="{{ route('login') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-outline mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo e-mail') }}</label>

                                @error('email')
                                <span class="invalid-feedback form-label" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col d-flex justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col">
                                @if (Route::has('password.request'))
                                    <a class="link-offset-2" href="{{ route('password.request') }}">
                                        {{ __('Dimenticato la password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row mb-0 justify-content-center">
                            <div class="col-md-3">
                                <button id="invia" type="submit" class="bg-access btn-block mb-4 text-black">
                                    {{ __('Accedi') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @vite(['resources/js/client-validation/LoginClientValidation.js'])
@endsection
