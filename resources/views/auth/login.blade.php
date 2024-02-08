@extends('layouts.app')
@section('title-name', 'Accedi')

@section('content')
<div class="container-fluid vh-100 hamburger">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-6 col-11">
            <div class="border-card mt-4">
                <div class="card-access">{{ __('Accedi') }}</div>

                <div class="card-body p-4">
                    <form id="formEl" method="POST" action="{{ route('login') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-outline mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo e-mail') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback form-label" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="">
                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Dimenticato la password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-3 mt-2">
                                <button id="invia" type="submit" class="bg-access btn-block mb-2 text-white">
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
