@extends('layouts.app')

@section('content')
    <div class="container content-center">
        <h1 class="text-3xl mb-3">Список пицц</h1>
        <a href="{{ route('pizzas.create') }}" class="btn btn-success text-xl">Создать пиццу</a>
        <table class="table mx-auto mt-3">
            <thead>
            <tr class="text-center">
                <th class="m-2">Название</th>
                <th class="m-2">Описание</th>
                <th class="m-2">Цена</th>
                <th class="m-2">Изображение</th>
                <th class="m-2">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->name }}</td>
                    <td>{{ $pizza->description }}</td>
                    <td>{{ $pizza->price }} р.</td>
                    <td><img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->name }}" style="width: 50px">
                    </td>
                    <td>
                        <a href="{{ route('pizzas.edit', $pizza->id) }}"
                           class="btn btn-primary btn-sm mr-2">Изменить</a>
                        <form action="{{ route('pizzas.destroy', $pizza->id) }}" method="post"
                              style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mr-2">Удалить</button>
                        </form>
                        <form action="{{ route('cart.add', ['type' => 'pizza', 'id' => $pizza->id]) }}" method="post"
                              style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Добавить в корзину</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
