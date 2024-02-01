@extends('layouts.app')
@section('title-name', 'Edit a dish')

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

                <form action="{{route('admin.dishes.update', $dish->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome del piatto</label>
                        <input required type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome.." value="{{ old('name', $dish->name)}}">
                    </div>

                    {{-- image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Inserisci un'immagine</label>
                        <input type="file" name="image" class="form-control" id="image" placeholder="Inserisci la foto del piatto.." value="{{ old('image')}}">
                    </div>

                    {{-- price --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text">&euro;</span>
                        <input required name="price" type="number" step="0.01" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{old('price', $dish->price)}}">
                        <span class="input-group-text">.00</span>
                    </div>

                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea required name="description" class="form-control" id="description" rows="3">{{ old('description', $dish->description) }}</textarea>
                    </div>

                    {{-- visibility --}}
                    <div class="mb-3">
                        <div class="form-check">
                            <input required class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility" @checked($dish->visibility === 1)>
                            <label class="form-check-label" for="visibility">
                              Visibilità ai clienti
                            </label>
                        </div>
                    </div>

                    {{-- btn --}}
                    <div class="mb-3">
                        <input type="submit" value="Salva" class="btn btn-primary">
                    </div>
                     {{-- btn indietro --}}
                     <div class="mb-3">
                        <a class="btn btn-secondary" href=" {{route ('admin.dishes.index') }}">Indietro</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
