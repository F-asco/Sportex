<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->has('search') && $request->input('search') != '') {
        $searchTerm = $request->input('search');
        $query->where('name', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%');
    }

    $produkty = $query->paginate(3)->withQueryString();

    return view('sklep_home', ['products' => $produkty]);
}

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'Pole "Nazwa produktu" jest wymagane.',
            'name.min' => 'Minimalna długość nazwy to 5 znaków.',
            'description.required' => 'Opis produktu jest wymagany.',
            'price.required' => 'Musisz podać cenę.',
            'price.numeric' => 'Cena musi być liczbą.',
            'price.min' => 'Cena musi wynosić minimum 1 zł.',
            'stock.required' => 'Stan magazynowy jest wymagany.',
        ]);

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ]);

        return redirect('/')->with('success', 'Produkt został dodany pomyślnie!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/')->with('success', 'Produkt został usunięty.');
    }
    public function edit($id)
{
    $product = \App\Models\Product::findOrFail($id);
    return view('products.edit', compact('product'));
}

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'Nazwa produktu jest wymagana.',
            'price.required' => 'Cena jest wymagana.',
            'price.numeric' => 'Cena musi być liczbą.',
            'stock.required' => 'Stan magazynowy jest wymagany.',
        ]);

        $product->update($validated);

        return redirect('/')->with('success', 'Produkt został pomyślnie zaktualizowany.');
    }
}