@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="header-cart mb-4 font-bold text-xl">Корзина</h1>
        @if(session('cart') && count(session('cart')) > 0)
            <table class="table mx-auto">
                <thead>
                <tr>
                    <th class="p-2">Название</th>
                    <th class="p-2">Тип</th>
                    <th class="p-2">Цена</th>
                    <th class="p-2">Количество</th>
                    <th class="p-2">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach (session('cart') as $cartKey => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['type'] }}</td>
                        <td>{{ $item['price'] }} р.</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $cartKey }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                       class="form-control" style="width: 70px;">
                                <button type="submit" class="btn btn-primary btn-sm">Обновить</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('cart.delete') }}" method="post" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $cartKey }}">
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="bot pt-4">
                <a href="{{ route('orders.create') }}" class="btn btn-success mb-4">Оформить заказ</a>
                @else
                    <p class="mb-2">Корзина пуста</p>
                    <p> Закажи что нибудь :)</p>
                @endif

            </div>
    </div>
@endsection
