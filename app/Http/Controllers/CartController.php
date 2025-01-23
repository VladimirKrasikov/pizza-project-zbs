<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Pizza;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', ['cart' => $cart]);
    }


    public function addToCart(Request $request, $type, $id)
    {
        $cart = session()->get('cart', []);
        $maxPizzas = 10;
        $maxDrinks = 20;
        if ($type == 'pizza') {
            $product = Pizza::find($id);
        } else {
            $product = Drink::find($id);
        }

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Продукт не найден');
        }
        $cartKey = $type . '_' . $product->id;
        $pizzaCount = 0;
        $drinkCount = 0;

        foreach ($cart as $key => $item) {
            if (strpos($key, 'pizza') !== false) {
                $pizzaCount += $item['quantity'];
            } elseif (strpos($key, 'drink') !== false) {
                $drinkCount += $item['quantity'];
            }
        }
        if ($type == 'pizza' && $pizzaCount >= $maxPizzas) {
            return redirect()->route('products.index')->with('error', 'Хватит жрать, максимум можно заказать ' . $maxPizzas . ' пицц');
        }
        if ($type == 'drink' && $drinkCount >= $maxDrinks) {
            return redirect()->route('products.index')->with('error', 'Максимальное количество напитков в корзине: ' . $maxDrinks);
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'name' => $product->name,
                'price' => $product->price,
                'type' => $type,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('products.index')->with('success', 'Продукт добавлен в корзину');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $maxPizzas = 10;
        $maxDrinks = 20;

        if ($request->id && $request->quantity) {
            $cartKey = $request->id;
            $pizzaCount = 0;
            $drinkCount = 0;
            foreach ($cart as $key => $item) {
                if (strpos($key, 'pizza') !== false) {
                    $pizzaCount += $item['quantity'];
                } elseif (strpos($key, 'drink') !== false) {
                    $drinkCount += $item['quantity'];
                }
            }

            $type = explode('_', $cartKey)[0];
            if ($type == 'pizza') {
                if ($request->quantity > $maxPizzas) {
                    session()->flash('error', 'Максимальное количество пицц в корзине: ' . $maxPizzas);
                    return redirect()->route('cart.index');
                }

                if (($pizzaCount - $cart[$cartKey]['quantity'] + $request->quantity) > $maxPizzas) {
                    session()->flash('error', 'Максимальное количество пицц в корзине: ' . $maxPizzas);
                    return redirect()->route('cart.index');
                }

            } else if ($type == 'drink') {
                if ($request->quantity > $maxDrinks) {
                    session()->flash('error', 'Максимальное количество напитков в корзине: ' . $maxDrinks);
                    return redirect()->route('cart.index');
                }

                if (($drinkCount - $cart[$cartKey]['quantity'] + $request->quantity) > $maxDrinks) {
                    session()->flash('error', 'Максимальное количество напитков в корзине: ' . $maxDrinks);
                    return redirect()->route('cart.index');
                }
            }

            $cart[$cartKey]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Корзина обновлена');
        return redirect()->route('cart.index');
    }

    public function deleteFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart', []);
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            session()->flash('success', 'Продукт удалён из корзины!');
        }
        return redirect()->route('cart.index');
    }
}
