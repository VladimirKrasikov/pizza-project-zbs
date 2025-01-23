@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Изменение напитка</h1>
        <form action="{{ route('drinks.update', $drink) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $drink->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" class="form-control">{{ $drink->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01"
                       value="{{ $drink->price }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($drink->image)
                    <img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}"
                         style="width: 100px; margin-top: 10px"/>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
