<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate;
use App\Models\Pizza;


class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart');
        return view('orders.create', ['cart' => $cart]);
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (!$cart) return redirect()->route('products.index')->with('error', 'Корзина пуста');
        if (count($cart) == 0) return redirect()->route('products.index')->with('error', 'Корзина пуста');

        $order = new Order();
        $order->user_id = Auth::id();
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->address = $request->address;

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $order->total_price = $totalPrice;
        $order->save();

        foreach ($cart as $cartKey => $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $parts = explode('_', $cartKey);
            if (count($parts) != 2) {
                continue;
            }
            $type = $parts[0];
            $productId = $parts[1];

            if ($type === 'pizza') {
                $product = Pizza::find($productId);
            } else {
                $product = Drink::find($productId);
            }

            $orderItem->product_id = $product->id;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();
        }

        session()->forget('cart');
        return redirect()->route('orders.history')->with('success', 'Заказ успешно оформлен');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.history', ['orders' => $orders]);
    }

}
