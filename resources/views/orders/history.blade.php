@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl">История заказов</h1>
        @if(count($orders) > 0)
            @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-header p-2">
                        Заказ №{{ $order->id }} - {{ $order->created_at }}
                        Сумма: {{$order->total_price}} р.
                    </div>
                </div>
            @endforeach
        @else
            <p>У вас еще нет заказов.</p>
        @endif
    </div>
@endsection
