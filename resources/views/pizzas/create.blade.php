@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl mb-4">Создание пиццы</h1>
        <form action="{{ route('pizzas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label m-4">Цена</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label mx-auto">Описание</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label m-3">Изображение</label>
                <input type="file" name="image" id="image" class="form-control ">
            </div>
            <button type="submit" class="btn rounded-full text-red-600">Сохранить</button>
        </form>
    </div>
@endsection
