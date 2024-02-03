@extends('layouts.app')
@section('title-name', 'Create restaurant')

@section('content')

    <div class="container">
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
                <form action="{{ route('admin.restaurants.store')}}" method='POST' class="py-4" enctype="multipart/form-data">
                    @csrf
                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome dell'attività</label>
                        <input required type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome.." value="{{ old('name')}}">
                    </div>
                    {{-- thumb --}}
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Inserisci un'immagine</label>
                        <input  type="file" name="thumb" class="form-control" id="thumb" placeholder="Inserisci la foto del ristorante.."  value="{{ old('file')}}">
                    </div>
                    {{-- categories --}}
                    <div class="mb-3 d-flex gap-3 flex-wrap">
                        <h4> Select one or more categories </h4>
                        <div class="d-flex gap-3 flex-wrap">
                            @foreach($categories as $category)
                                <input
                                    name="categories[]"
                                    class="form-check-input"
                                    type="checkbox" value="{{$category->id}}"
                                    id="item-{{$category->id}}"
                                    @checked(in_array($category->id, old('categories', [])))
                                >
                                <label class="form-check-label" for="item-{{$category->id}}">
                                    {{$category->name}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    {{-- address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Inserisci l'indirizzo</label>
                        <input required type="text" name="address" class="form-control" id="address" placeholder="Inserisci l'indirizzo.." value="{{ old('address')}}">
                    </div>
                    {{-- vat --}}
                    <div class="mb-3">
                        <label for="vat" class="form-label">Inserisci numero Partita IVA</label>
                        <input required type="text" name="vat" class="form-control" id="vat" placeholder="Inserisci numero Partita IVA.." value="{{ old('vat')}}">
                    </div>
                    {{-- btn --}}
                    <div class="mb-3">
                        <input type="submit" value="Crea" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
