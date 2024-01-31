@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Aggiungi Ristorante') }}</div>

                <div class="card-body">
                    <a href="{{ route('admin.restaurants.create')}}">Aggiungi Ristorante</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
