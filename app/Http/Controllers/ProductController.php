<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Drink;
use App\Models\Pizza;
use Illuminate;


class ProductController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();
        $drinks = Drink::all();
        return view('products.index', ['pizzas' => $pizzas, 'drinks' => $drinks]);
    }
}
