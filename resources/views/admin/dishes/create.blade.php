@extends('layouts.app')
@section('title-name', 'Aggiungi un piatto al menù')

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

                <form action="{{route('admin.dishes.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome del piatto</label>
                        <input required type="text" name="name" class="form-control" id="name" placeholder="Nome.." value="{{ old('name')}}">
                    </div>

                    {{-- image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine</label>
                        <input required type="file" name="image" class="form-control" id="image" placeholder="Foto del piatto.." value="{{ old('image')}}">
                    </div>

                    {{-- price --}}
                    <div class=" mb-3">
                        <label class="form-label" for="price"> Prezzo </label>
                        <div class="input-group">
                            <span class="input-group-text">&euro;</span>
                            <input required name="price" type="number" step="0.01" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{old('price')}}">
                        </div>
                    </div>

                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea required name="description" class="form-control" id="description" rows="3"> {{ old('description') }} </textarea>
                    </div>

                    {{-- visibility --}}
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility" checked>
                            <label class="form-check-label" for="visibility">
                              Visibilità
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        {{-- btn --}}
                        <div class="mb-3">
                            <input type="submit" value="Salva" class="btn btn-primary">
                        </div>

                        {{-- btn indietro --}}
                        <div class="mb-3">
                            <a class="btn btn-secondary" href=" {{route ('admin.dashboard') }}">Indietro</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
