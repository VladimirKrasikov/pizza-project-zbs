<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pizzas = Pizza::all();
        return view('pizzas.index', compact('pizzas'));
    }

    public function create()
    {
        return view('pizzas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $pizza->image = 'images/' . $imageName;
        }
        $pizza->save();

        return redirect()->route('pizzas.index')->with('success', 'Пицца успешно создана');
    }

    public function show(Pizza $pizza)
    {
        return view('pizzas.show', compact('pizza'));
    }

    public function edit(Pizza $pizza)
    {
        return view('pizzas.edit', compact('pizza'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $pizza->image = 'images/' . $imageName;
        }
        $pizza->save();

        return redirect()->route('pizzas.index')->with('success', 'Пицца успешно обновлена');
    }

    public function destroy(Pizza $pizza)
    {
        if ($pizza->image) {
            Storage::disk('public')->delete($pizza->image);
        }
        $pizza->delete();

        return redirect()->route('pizzas.index')->with('success', 'Пицца успешно удалена!');
    }
}
