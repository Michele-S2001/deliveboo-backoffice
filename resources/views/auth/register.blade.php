@extends('layouts.app')
@section('title-name', 'Effettua il login')

@section('content')
<div class="container-fluid vh-100 hamburger">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-6 col-11">
            <div class="border-card mt-4">
                <div class="card-access text-white">{{ __('Registrazione') }}</div>

                <div class="card-body p-4">
                    <form id="formEl" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="form-outline mb-4">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <input required id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"   autocomplete="name" autofocus>
                                
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-outline mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo e-mail') }}</label>

                                <input required id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-outline mb-4">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <input required id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-outline mb-4">
                                <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Conferma la Password') }}</label>
                                
                                <input required id="password-confirm" type="password" class="form-control" name="password_confirmation"   autocomplete="new-password">
                            </div>
                        </div>  

                        <div class="row justify-content-center">
                            <div class="col-3">
                                <button id="invia" type="submit" class="btn_register btn-block mb-2 text-white">
                                    {{ __('Registrati') }}
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
    @vite(['resources/js/client-validation/RegisterClientValidation.js'])
@endsection
