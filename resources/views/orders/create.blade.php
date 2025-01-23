@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl pb-4">Оформление заказа</h1>
        @if(session('cart'))
            @if(count(session('cart')) > 0)
                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <div class="mb-3 text-center">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="mb-3 text-center">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3 text-center">
                        <label for="address" class="form-label text-center">Адрес доставки</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Оформить заказ</button>
                </form>
            @else
                <p>Корзина пуста</p>
            @endif
        @endif
    </div>
@endsection
