<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * 1️⃣ View the Cart Page
     * Points to: resources/views/cart/index.blade.php
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Use dot notation to access the folder: 'folderName.fileName'
        return view('cart.index', compact('cart'));
    }

    /**
     * 2️⃣ Add Item to Cart
     */
    public function addToCart(Request $request, $id)
{
    $food = \App\Models\Food::findOrFail($id);
    $cart = session()->get('cart', []);
    $qty = $request->input('quantity', 1); // Get number from the form

    if(isset($cart[$id])) {
        $cart[$id]['quantity'] += $qty;
    } else {
        $cart[$id] = [
            "name" => $food->name,
            "quantity" => $qty,
            "price" => $food->price,
            "image" => $food->image,
            "spicy" => $request->spicy ?? 'Normal'
        ];
    }

    session()->put('cart', $cart);
    return redirect()->route('cart.index')->with('success', 'Added to cart!');
}

    /**
     * 3️⃣ Remove Item from Cart
     * Updated to handle the ID from the URL/Route
     */
    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('status', 'Item removed from basket.');
    }
}