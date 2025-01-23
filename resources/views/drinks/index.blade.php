@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-3xl mb-3">Список напитков</h1>
        <a href="{{ route('drinks.create') }}" class="btn btn-success text-xl">Создать напиток</a>
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
            @foreach ($drinks as $drink)
                <tr>
                    <td>{{ $drink->name }}</td>
                    <td>{{ $drink->description }}</td>
                    <td>{{ $drink->price }} р.</td>
                    <td><img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}" style="width: 50px">
                    </td>
                    <td>
                        <a href="{{ route('drinks.edit', $drink->id) }}" class="btn btn-primary btn-sm mr-2">Изменить</a>
                        <form action="{{ route('drinks.destroy', $drink->id) }}" method="post"
                              style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mr-2">Удалить</button>
                        </form>
                        <form action="{{ route('cart.add', ['type' => 'drink', 'id' => $drink->id]) }}" method="post"
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
