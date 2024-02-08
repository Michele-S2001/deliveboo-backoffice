@extends('layouts.app')
@section('title-name', 'Effettua il login')

@section('content')
<div class="container-fluid vh-100 hamburger">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="border-card mt-4">
                <div class="card_header">{{ __('Registrazione') }}</div>

                <div class="card-body p-4">
                    <form id="formEl" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="form-outline mb-4">
                                <input required id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"   autocomplete="name" autofocus>

                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-outline mb-4">
                                <input required id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   autocomplete="email">

                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo e-mail') }}</label>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-outline mb-4">
                                <input required id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   autocomplete="new-password">
                                
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>


                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-outline mb-4">
                                <input required id="password-confirm" type="password" class="form-control" name="password_confirmation"   autocomplete="new-password">
                                
                                <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Conferma la Password') }}</label>
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
