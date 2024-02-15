@extends('layouts.app')
@section('title-name', 'Tutti i piatti')

@section('content')
    @if(Auth::user()->restaurant->dishes->isNotEmpty())
        <div class="container py-5">
            <h2 class="mb-5 text-black">I tuoi piatti</h2>
            <a href="{{ route('admin.dishes.create') }}" class="btn_add_dish2 mb-2 mb-sm-0">Aggiungi un piatto</a>
            <a href="{{ route('admin.dashboard') }}" class="btn_add_dish2 mb-2 mb-sm-0">Torna al tuo ristorante</a>
            <div class="row">
                @foreach($dishes as $dish)
                    <div class="col-lg-6 col-xxl-4 mb-4">
                        <div class="bg_card card_relative h-100 border-0 rounded-3 shadow-sm">
                            <img src="{{ asset('storage/' . $dish->image ) }}" class="image_card rounded-top" alt="{{ $dish->name }}">
                            <div class="card_body d-flex flex-column" id="text_center">
                                <h5 class="card-title"> {{  $dish->name }} </h5>
                                <p class="card-text"> {{ $dish->description }} </p>
                                <p class="card-text">Prezzo: {{ $dish->price }} &euro;</p>
                                <p class="card-text">Visibilità: {{ $dish->visibility ? 'Si' : 'No'}} </p>
                                <div class="d-flex gap-3 mt-auto btn_absolute">
                                    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn_add_dish">Modifica</a>
                                    <button type="button" class="btn_delete" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $dish->id }}">Elimina</button>
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
