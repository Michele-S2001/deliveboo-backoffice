@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista Piatti</h2>
        <div class="row">
           @foreach($dishes as $dish)
           <div class="col-sm-6 col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}">
                    <div class="card-body">
                        <h5 class="card-title"> {{  $dish->name }} </h5>
                        <p class="card-text"> {{ $dish->description }} </p>
                        <p class="card-text">Prezzo: {{ $dish->price }}</p>
                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-primary">Modifica</a>
                        <form id="{{'form-'.$dish->id}}" action="{{route('admin.dishes.destroy', $dish)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input data-delete data-target="#form-{{ $dish->id }}"  class="btn btn-sm btn-danger" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection