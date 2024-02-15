@extends('layouts.app')
@section('content')

<div class="container pb-5">
<a href="{{ route('admin.dashboard') }}" class="btn_add_dish2 mt-5">Torna al tuo ristorante</a>
    <h2 class="fs-4 text-secondary text-white ">
        {{ __('Profile') }}
    </h2>
    <div class="card_profile p-4 mb-4 shadow rounded-lg">

        @include('profile.partials.update-profile-information-form')

    </div>

    <div class="card_profile p-4 mb-4 shadow rounded-lg">


        @include('profile.partials.update-password-form')

    </div>

    <div class="card_profile p-4 shadow rounded-lg">


        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection
