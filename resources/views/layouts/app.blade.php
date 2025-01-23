<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Если не тупица - купи пиццу</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-4 text-center border-gray-400 font-bold">
<div class="container">
    <header class="pizza-site-header">
        <nav class="navbar">
            <div class="container p-4">
                <a class="navbar-brand text-4xl text-rose-500" href="{{ url('/') }}">
                    Если не тупица - купи пиццу
                </a>
            </div>
            <div class="p-4 flex justify-between items-center">
                <ul class="navbar-nav flex ">
                    <li class="nav-item pr-4">
                        <a href="{{ route('pizzas.index') }}" class="nav-link">Пиццы</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('drinks.index') }}" class="nav-link">Напитки</a>
                    </li>
                </ul>
                <ul class="navbar-nav flex">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item nav-item pr-4">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-red-600" href="#"
                               role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item mr-2 text-green-600"
                                   href="{{ route('cart.index') }}">Корзина</a>
                                <a class="dropdown-item mr-2 text-green-600" href="{{ route('orders.history') }}">История
                                    заказов</a>
                                <a class="dropdown-item mr-2 text-green-600" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
