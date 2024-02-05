@extends('layouts.app')
@section('title-name', 'Dashboard del ristoratore')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
    </div>
    <section class="restaurant-overview">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header">{{ __('Ristorante') }}</div>

                        <div class="card-body">
                            @if (auth()->check() && !(auth()->user()->restaurant))
                            <a href="{{ route('admin.restaurants.create')}}">Aggiungi Ristorante</a>
                                @else
                                <div class="row">
                                    <div class="col-md-6">
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
                                    </div>
                                    <div class="col-md-6">
                                        <img class="w-100" src="{{ asset('storage/' . Auth::user()->restaurant->thumb ) }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(Auth::user()->restaurant)
        <section class="dish-tools py-3">
            <div class="container">
                <a class="btn btn-primary" href="{{route('admin.dishes.create')}}">Aggiungi piatto</a>

                {{-- se l'utente con un ristorante ha anche dei piatti --}}
                @if(Auth::user()->restaurant->dishes->isNotEmpty())
                    <a class="btn btn-success"href="{{ route('admin.dishes.index') }}">Lista piatti</a>
                @endif
            </div>
        </section>
    @endif
@endsection
