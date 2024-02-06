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
                <form id="create-restaurant-form" action="{{ route('admin.restaurants.store')}}" method='POST' class="py-4" enctype="multipart/form-data">
                    @csrf
                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome dell'attività</label>
                        <input required type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome.." value="{{ old('name')}}">
                        <span id="name-error" class="text-danger"></span>
                    </div>
                    {{-- thumb --}}
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Immagine</label>
                        <input required type="file" name="thumb" class="form-control" id="thumb" placeholder="Inserisci la foto del ristorante.."  value="{{ old('file')}}">
                        <span id="thumb-error" class="text-danger"></span>
                    </div>
                    {{-- categories --}}
                    <div class="mb-3 d-flex gap-3 flex-wrap">
                        <h4> Seleziona una o più categorie </h4>
                        <div class="d-flex gap-3 flex-wrap">
                            @foreach($categories as $category)
                                <input
                                    name="categories[]"
                                    class="form-check-input category-checkbox"
                                    type="checkbox" value="{{$category->id}}"
                                    id="item-{{$category->id}}"
                                    @checked(in_array($category->id, old('categories', [])))
                                >
                                <label class="form-check-label" for="item-{{$category->id}}">
                                    {{$category->name}}
                                </label>
                            @endforeach
                        </div>
                        <span id="category-error" class="text-danger"></span>
                    </div>
                    {{-- address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input required type="text" name="address" class="form-control" id="address" placeholder="Indirizzo.." value="{{ old('address')}}">
                        <span id="address-error" class="text-danger"></span>
                    </div>
                    {{-- vat --}}
                    <div class="mb-3">
                        <label for="vat" class="form-label">Partita IVA</label>
                        <input required type="text" name="vat" class="form-control" id="vat" placeholder="Partita IVA.." value="{{ old('vat')}}">
                        <span id="vat-error" class="text-danger"></span>
                    </div>
                    {{-- btn --}}
                    <div class="mb-3">
                        <input type="button" value="Crea" class="btn btn-primary" id="submit-btn">
                    </div>
                </form>

            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("submit-btn").addEventListener("click", function() {
                const name = document.getElementById("name").value;
                const thumb = document.getElementById("thumb").value;
                const categories = document.querySelectorAll('.category-checkbox:checked').length;
                const address = document.getElementById("address").value;
                const vat = document.getElementById("vat").value;
                const nameError = document.getElementById("name-error");
                const thumbError = document.getElementById("thumb-error");
                const categoryError = document.getElementById("category-error");
                const addressError = document.getElementById("address-error");
                const vatError = document.getElementById("vat-error");

                if (name === "") {
                    nameError.innerText = "Si prega di inserire il nome dell'attività.";
                } else {
                    nameError.innerText = "";
                }

                if (thumb === "") {
                    thumbError.innerText = "Si prega di selezionare un'immagine.";
                } else {
                    thumbError.innerText = "";
                }

                if (categories === 0) {
                    categoryError.innerText = "Si prega di selezionare almeno una categoria.";
                } else {
                    categoryError.innerText = "";
                }

                if (address === "") {
                    addressError.innerText = "Si prega di inserire l'indirizzo.";
                } else {
                    addressError.innerText = "";
                }

                if (vat === "") {
                    vatError.innerText = "Si prega di inserire la partita IVA.";
                } else {
                    vatError.innerText = "";
                }

                if (name !== "" && thumb !== "" && categories > 0 && address !== "" && vat !== "") {
                    document.getElementById("create-restaurant-form").submit();
                }
            });
        });
    </script>

@endsection

