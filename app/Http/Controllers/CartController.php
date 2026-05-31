<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', ['cart' => $cart, 'total' => $total]);
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Dodano produkt do koszyka!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Usunięto produkt z koszyka.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Twój koszyk jest pusty!');
        }

        DB::transaction(function () use ($cart) {
            foreach ($cart as $id => $details) {
                $product = Product::findOrFail($id);
                
                if ($product->stock < $details['quantity']) {
                    throw new \Exception("Niestety, brak wystarczającej ilości produktu: {$product->name}");
                }

                Order::create([
                    'user_id' => auth()->id(),
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'total_price' => $details['price'] * $details['quantity'],
                ]);

                $product->decrement('stock', $details['quantity']);
            }
        });

        session()->forget('cart');

        return redirect('/')->with('success', 'Dziękujemy! Zamówienie zostało złożone pomyślnie.');
    }
}