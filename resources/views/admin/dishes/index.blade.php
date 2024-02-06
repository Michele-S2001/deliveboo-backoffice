@extends('layouts.app')
@section('title-name', 'Tutti i piatti')

@section('content')
    @if(Auth::user()->restaurant->dishes->isNotEmpty())
        <div class="container py-5">
            <h2 class="mb-5">Lista Piatti</h2>
            <div class="row">
            @foreach($dishes as $dish)
            <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img class="card__image-dish" src="{{ asset('storage/' . $dish->image ) }}" class="card-img-top" alt="{{ $dish->name }}">
                        <div class="card-body">
                            <h5 class="card-title"> {{  $dish->name }} </h5>
                            <p class="card-text"> {{ $dish->description }} </p>
                            <p class="card-text">Prezzo: {{ $dish->price }} &euro;</p>
                            <p class="card-text">Visibilità: {{ $dish->visibility ? 'Si' : 'No'}} </p>
                            <div class="d-flex gap-3">
                                <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-primary">Modifica</a>
                                <form id="{{'form-'.$dish->id}}" action="{{route('admin.dishes.destroy', $dish)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input data-delete data-target="#form-{{ $dish->id }}"  class="btn btn-danger" type="submit" value="Delete">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="container py-5">
            <h2 class="mb-5">Nessun Piatto Disponibile</h2>
            <p>Al momento non ci sono piatti disponibili nel ristorante.</p>
        </div>
    @endif

@endsection
