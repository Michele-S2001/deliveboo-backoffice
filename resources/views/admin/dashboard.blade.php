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
                    @if (auth()->check() && !(auth()->user()->restaurant))
                    <a href="{{ route('admin.restaurants.create')}}">Aggiungi Ristorante</a>
                        @else
                        <h3>
                            {{ Auth::user()->restaurant->name }}
                        </h3>
                        <p>
                            Indirizzo: {{ Auth::user()->restaurant->address }}
                        </p>
                        <p>
                            Partita iva: {{ Auth::user()->restaurant->vat }}
                        </p>
                        <p>
                            {{ Auth::user()->restaurant->category }}
                        </p>
                        <img class="w-100" src="{{ asset('storage/' . Auth::user()->restaurant->thumb ) }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
