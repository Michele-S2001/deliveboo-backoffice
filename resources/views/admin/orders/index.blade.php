@extends('layouts.app')
@section('title-name', 'Tutti i tuoi ordini')

@section('content')

<div class="container py-5">
    <h2 class="mb-4">Lista ordini</h2>
    <p class="fs-5 mb-5">In ogni ordine sono presenti i dati del cliente, il totale del pagamento e la lista dei piatti con annessa quantità</p>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @forelse($orders as $order)
                <div class="order_card">
                    <div class="order_card__main-data">
                        <ul class="data-list">
                            <li class="data">
                                <span class="data__label">ID dell'ordine</span>
                                <p class="data__text">{{ $order->id }}</p>
                            </li>
                            <li class="data">
                                <span class="data__label">Nome e Cognome cliente</span>
                                <p class="data__text">{{ $order->full_name }}</p>
                            </li>
                            <li class="data">
                                <span class="data__label">Indirizzo ordine</span>
                                <p class="data__text">{{ $order->delivery_address }}</p>
                            </li>
                            <li class="data">
                                <span class="data__label">Numero cliente</span>
                                <p class="data__text">{{ $order->phone_number }}</p>
                            </li>
                            <li class="data">
                                <span class="data__label">Totale dell'ordine</span>
                                <p class="data__text"> {{ $order->subtotal}} </p>
                            </li>
                        </ul>
                    </div>
                    <div class="order_card__additional-data">
                        <ul class="data-list">
                            <li class="data">
                                <span class="data__label">Note aggiuntive</span>
                                <p class="data__text">
                                    {{ $order->notes}}
                                </p>
                            </li>
                        </ul>
                        <h5>Lista dei piatti e quantità</h5>
                        <ul class="dishes-list">
                            @foreach($order->dishes as $dish)
                            <li> {{$dish->name}} <strong>x{{$dish->pivot->quantity}}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <h4 class="text-center">Non ci sono ordini presenti</h4>
            @endforelse
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Torna al tuo ristorante</a>
        </div>
    </div>


</div>

@endsection
