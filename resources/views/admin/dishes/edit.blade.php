@extends('layouts.app')
@section('title-name', 'Modifica il piatto')

@section('content')

    <div class="container py-4" style="min-height: 100vh">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
            <div class="card-access text-white"><strong>{{ __('Modifica il tuo piatto') }}</strong></div>

            <div class="card-body bg_card_profile border rounded p-4">
                    <form id="editForm" action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome del piatto</label>
                            <input required type="text" name="name" class="form-control" id="name" placeholder="Nome.." value="{{ old('name', $dish->name)}}">
                            <span id="name-error" class="text-danger"></span>
                        </div>

                        {{-- image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="file" onchange="previewThumb(event)" name="image" class="form-control" id="image" placeholder="Foto del piatto.." value="{{ old('image')}}">
                            <span id="image-error" class="text-danger"></span>
                            {{-- thumb-preview --}}
                            <div class="thumb-wrapper p-3">
                                <img class="w-100 form-img" id="thumb-preview" src="#" alt="">
                            </div>
                        </div>

                        {{-- price --}}
                        <div class="mb-3">
                            <label class="form-label" for="price"> Prezzo </label>
                            <div class="input-group">
                                <span class="input-group-text">&euro;</span>
                                <input required name="price" id="price" type="number" step="0.01" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{old('price', $dish->price)}}">
                            </div>
                            <span id="price-error" class="text-danger"></span>
                        </div>

                        {{-- description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea required name="description" class="form-control" id="description" rows="3">{{ old('description', $dish->description) }}</textarea>
                            <span id="description-error" class="text-danger"></span>
                        </div>

                        {{-- visibility --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility" @checked($dish->visibility === 1)>
                                <label class="form-check-label" for="visibility">
                                    Visibilità
                                </label>
                            </div>
                            {{-- <span id="visibility-error" class="text-danger"></span> --}}
                        </div>

                        <div class="d-flex gap-3">
                            {{-- btn --}}
                            <div class="mb-3">
                                <button type="button" id="submit-btn" class="btn_add_dish" data-bs-toggle="modal" data-bs-target="#confirmSaveModal">Salva</button>
                            </div>
                            {{-- btn indietro --}}
                            <div class="mb-3">
                                <a class="btn_add_dish" href="{{ route('admin.dishes.index') }}">Indietro</a>
                            </div>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </form>
            </div>
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
                    <button type="submit" class="btn_add_dish" form="editForm">Conferma</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('script')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("submit-btn").addEventListener('click', function() {
                const name = document.getElementById('name').value;
                const image = document.getElementById('image').files.length;
                const price = document.getElementById('price').value;
                const description = document.getElementById('description').value;
                // const visibility = document.getElementById('visibility').checked;
                const nameError = document.getElementById('name-error');
                const imageError = document.getElementById('image-error');
                const priceError = document.getElementById('price-error');
                const descriptionError = document.getElementById('description-error');
                // const visibilityError = document.getElementById('visibility-error');

                if (name === "") {
                    nameError.innerHTML = "Il campo nome è obbligatorio";
                } else {
                    nameError.innerHTML = "";
                }
                /*
                if (image === 0) {
                    imageError.innerHTML = "Il campo immagine è obbligatorio";
                } else {
                    imageError.innerHTML = "";
                }
                */
                if (price === "") {
                    priceError.innerHTML = "Il campo prezzo è obbligatorio";
                } else {
                    priceError.innerHTML = "";
                }

                if (description === "") {
                    descriptionError.innerHTML = "Il campo descrizione è obbligatorio";
                } else {
                    descriptionError.innerHTML = "";
                }

                if (name !== "" && image > 0 && price !== "" && description !== "") {
                    document.getElementById('editForm').submit();
                }
        });
    });
    // --------- Thumb Preview -------- //

    // Rimuovo la classe p-3
    let thumbWrapper = document.querySelector('.thumb-wrapper')
            thumbWrapper.classList.remove('p-3')

            function previewThumb(event) {
                // Ottiene l'elemento che ha scatenato l'evento (input file)
                let input = event.target;
                console.log(input);

                let preview = document.getElementById('thumb-preview');
                console.log(preview);

                // Verifica se sono stati selezionati dei file nell'input file
                if (input.files && input.files[0]) {
                    // Se ci sono file selezionati, crea un nuovo oggetto FileReader
                    let reader = new FileReader();

                    // Definisce cosa fare quando il FileReader ha completato la lettura del file
                    reader.onload = function (e) {
                        // Imposta l'URL del file come sorgente dell'elemento anteprima
                        preview.src = e.target.result;

                        preview.style.display = 'block';
                    }

                    // Avvia la lettura del file come URL dati
                    reader.readAsDataURL(input.files[0]);

                    // Aggiungo la classe p-3 dopo l'aggiunta della thumb-preview
                    thumbWrapper.classList.add('p-3')

                }
            }
    </script>

@endsection
