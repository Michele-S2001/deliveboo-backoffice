@extends('layouts.app')
@section('title-name', 'Create restaurant')

@section('content')

    <div class="container">
        <div class="row justify-center">
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
                <form action="{{ route('admin.restaurants.store')}}" method='POST' class="py-4">
                    @csrf
                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome dell'attività</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome.." value="{{ old('name')}}">
                    </div>
                    {{-- thumb --}}
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Inserisci un'immagine</label>
                        <input type="file" name="thumb" class="form-control" id="thumb" placeholder="Inserisci la foto del ristorante.."  value="{{ old('file')}}">
                    </div>
                    {{-- address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Inserisci l'indirizzo</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Inserisci l'indirizzo.." value="{{ old('address')}}">
                    </div>
                    {{-- vat --}}
                    <div class="mb-3">
                        <label for="vat" class="form-label">Inserisci numero Partita IVA</label>
                        <input type="text" name="vat" class="form-control" id="vat" placeholder="Inserisci numero Partita IVA.." value="{{ old('vat')}}">
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