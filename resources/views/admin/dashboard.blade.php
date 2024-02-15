@extends('layouts.app')
@section('title-name', 'Dashboard del ristoratore')

@section('content')
    <section class="restaurant-overview">
        <div class="container">
            <div class="row justify-content-center">
                <div class="pt-4">
                    <div class="container static-img text-white h-100 rounded">
                        @if (auth()->check() && !(auth()->user()->restaurant))
                        <div class="wrap">
                            <a class="button text-decoration-none" href="{{ route('admin.restaurants.create')}}">
                                Aggiungi Ristorante
                            </a>
                        </div>
                        @else
                            <div class="row h-100 pb-4">
                                <div class="col-md-6 ps-md-5 d-flex justify-content-end flex-column">
                                    <div class="restaurant-tag p-4 w-100">
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

                                </div>
                                <div class="col-md-6 d-flex justify-content-center align-items-center">
                                    @if(Auth::user()->restaurant)
                                        <section class="py-3">
                                            <div class="container d-flex flex-column gap-3">
                                                <div class="col-12">
                                                    <a href="{{ url('profile') }}" class="button text-decoration-none">Il tuo profilo</a>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6 ps-2 mb-3">
                                                        <a class="button text-decoration-none" href="{{route('admin.orders.index')}}">I tuoi ordini</a>
                                                    </div>

                                                    {{-- se l'utente con un ristorante ha anche dei piatti --}}
                                                    @if(Auth::user()->restaurant->dishes->isNotEmpty())
                                                    <div class="col-sm-6 ps-2 mb-3">
                                                        <a class="button text-decoration-none" href="{{ route('admin.dishes.index') }}">I tuoi piatti</a>
                                                    </div>
                                                    @else
                                                    <div class="col-sm-6 ps-2 mb-2">
                                                        <a href="{{ route('admin.dishes.create') }}" class="button text-decoration-none">Aggiungi un piatto</a>
                                                    </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </section>
                                    @endif
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- <div class="card-body box-shadow">
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
    </div> --}}

@endsection
