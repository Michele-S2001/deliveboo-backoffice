@extends('layouts.app')
@section('title-name', 'Modifica il piatto')

@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="editForm" action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome del piatto</label>
                        <input required type="text" name="name" class="form-control" id="name" placeholder="Nome.." value="{{ old('name', $dish->name)}}">
                    </div>

                    {{-- image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine</label>
                        <input type="file" name="image" class="form-control" id="image" placeholder="Foto del piatto.." value="{{ old('image')}}">
                    </div>

                    {{-- price --}}
                    <div class="mb-3">
                        <label class="form-label" for="price"> Prezzo </label>
                        <div class="input-group">
                            <span class="input-group-text">&euro;</span>
                            <input required name="price" type="number" step="0.01" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{old('price', $dish->price)}}">
                        </div>
                    </div>

                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea required name="description" class="form-control" id="description" rows="3">{{ old('description', $dish->description) }}</textarea>
                    </div>

                    {{-- visibility --}}
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility" @checked($dish->visibility === 1)>
                            <label class="form-check-label" for="visibility">
                                Visibilità
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        {{-- btn --}}
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmSaveModal">Salva</button>
                        </div>
                        {{-- btn indietro --}}
                        <div class="mb-3">
                            <a class="btn btn-secondary" href="{{ route('admin.dishes.index') }}">Indietro</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal di conferma salvataggio -->
    <div class="modal" id="confirmSaveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Conferma salvataggio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sei sicuro di voler salvare le modifiche?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" form="editForm">Conferma</button>
                </div>
            </div>
        </div>
    </div>

@endsection
