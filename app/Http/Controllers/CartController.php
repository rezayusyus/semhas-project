<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('keranjang', compact('cart', 'total'));
    }

    public function removeItem(Request $request)
    {
        $cart = session()->get('cart', []);

        unset($cart[$request->index]);

        session()->put('cart', $cart);

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function addItem(Request $request)
    {
        $cart = session()->get('cart', []);

        $newItem = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ];

        $cart[] = $newItem;

        session()->put('cart', $cart);

        return back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        $selectedItems = $request->input('selected_items', []);

        $remainingCart = array_filter($cart, function ($item, $index) use ($selectedItems) {
            return !in_array($index, $selectedItems);
        }, ARRAY_FILTER_USE_BOTH);

        session()->put('cart', $remainingCart);

        return back()->with('success', 'Checkout berhasil. Item terpilih telah dihapus dari keranjang.');
    }
}
