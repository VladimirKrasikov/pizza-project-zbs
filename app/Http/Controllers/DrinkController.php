<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $drinks = Drink::all();
        return view('drinks.index', compact('drinks'));
    }

    public function create()
    {
        return view('drinks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $drink = new Drink();
        $drink->name = $request->name;
        $drink->description = $request->description;
        $drink->price = $request->price;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $drink->image = 'images/' . $imageName;
        }
        $drink->save();

        return redirect()->route('drinks.index')->with('success', 'Напиток успешно создан');
    }

    public function show(Drink $drink)
    {
        return view('drinks.show', compact('drink'));
    }

    public function edit(Drink $drink)
    {
        return view('drinks.edit', compact('drink'));
    }

    public function update(Request $request, Drink $drink)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $drink->name = $request->name;
        $drink->description = $request->description;
        $drink->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $drink->image = 'images/' . $imageName;
        }
        $drink->save();

        return redirect()->route('drinks.index')->with('success', 'Напиток успешно обновлен');
    }

    public function destroy(Drink $drink)
    {
        if ($drink->image) {
            Storage::disk('public')->delete($drink->image);
        }
        $drink->delete();

        return redirect()->route('drinks.index')->with('success', 'Напиток успешно удален!');
    }
}
