@extends('layouts.app')
@section('title-name', 'Tutti i piatti')

@section('content')
    @if(Auth::user()->restaurant->dishes->isNotEmpty())
        <div class="container py-5">
            <h2 class="mb-5">Lista Piatti</h2>
            <div class="row">
                @foreach($dishes as $dish)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img class="card__image-dish" src="{{ asset('storage/' . $dish->image ) }}" class="card-img-top" alt="{{ $dish->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"> {{  $dish->name }} </h5>
                                <p class="card-text"> {{ $dish->description }} </p>
                                <p class="card-text">Prezzo: {{ $dish->price }} &euro;</p>
                                <p class="card-text">Visibilità: {{ $dish->visibility ? 'Si' : 'No'}} </p>
                                <div class="d-flex gap-3 mt-auto">
                                    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-primary">Modifica</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $dish->id }}">Elimina</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal di conferma eliminazione -->
                    <div class="modal" id="deleteModal-{{ $dish->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Conferma eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Sei sicuro di voler eliminare questo piatto?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form id="deleteForm-{{ $dish->id }}" action="{{ route('admin.dishes.destroy', $dish) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Conferma</button>
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
