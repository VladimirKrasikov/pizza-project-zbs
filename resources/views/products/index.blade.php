@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-3xl mb-2">Общее Меню</h1>
        <h2 class="text-2xl mb-3">Пиццы</h2>
        <div class="row">
            @foreach ($pizzas as $pizza)
                <div class="mb-6 flex justify-center items-center">
                    <div class="card">
                        <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" alt="{{ $pizza->name }}"
                             style="width: 200px; margin: auto;display:block;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pizza->name }}</h5>
                            <p class="card-text">{{ $pizza->description }}</p>
                            <p class="card-text">Цена: {{ $pizza->price }} р.</p>
                            <form action="{{ route('cart.add', ['type' => 'pizza', 'id' => $pizza->id]) }}"
                                  method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary text-red-700">В корзину -></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2 class="text-2xl m-6">Напитки</h2>
        <div class="row">
            @foreach($drinks as $drink)
                <div class="mb-6 flex justify-center items-center">
                    <div class="card">
                        <img src="{{ asset('storage/' . $drink->image) }}" class="card-img-top" alt="{{ $drink->name }}"
                             style="width: 200px; margin: auto;display:block;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $drink->name }}</h5>
                            <p class="card-text">{{ $drink->description }}</p>
                            <p class="card-text">Цена: {{ $drink->price }}р</p>
                            <form action="{{ route('cart.add', ['type' => 'drink', 'id' => $drink->id]) }}"
                                  method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">В корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
