<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * 1️⃣ Display the Checkout Page
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $cartItems = collect($cart);

        // Calculate subtotal
        $subtotal = $cartItems->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout', compact('cartItems', 'subtotal'));
    }

    /**
     * 2️⃣ Place Order Logic
     */
    public function place(Request $request)
    {
        // FIX: Match the 'name' attributes in your checkout.blade.php
        $request->validate([
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:500',
            'payment_method' => 'required|string|in:COD,aba', 
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }

        // ... inside your place() function, inside the DB::transaction block ...

return DB::transaction(function () use ($request, $cart) {
    $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    $totalWithDelivery = $subtotal + 2.00;

    // 1. Create the main Order
    // 1. Create the main Order
$order = Order::create([
    'user_id'          => Auth::id(),
    'name'             => Auth::user()->name, 
    'order_number'     => 'KK' . rand(100000, 999999), 
    'total_amount'     => $totalWithDelivery,
    'status'           => 'pending',
    'phone'            => $request->phone,
    'payment_method'   => $request->payment_method,
    
    // We send the address to BOTH columns just to be safe 
    // and satisfy the database requirement
    'address'          => $request->address, 
    'delivery_address' => $request->address,
]);

    // 2. Save individual items
    foreach ($cart as $id => $details) {
        OrderItem::create([
            'order_id'  => $order->id,
            'food_id'   => $id,               // This is the item ID from your cart session
            'food_name' => $details['name'], // The name of the dish
            'quantity'  => $details['quantity'],
            'price'     => $details['price'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('order.success', $order->id)
                     ->with('success', 'Order placed successfully!');
});
    }

    /**
     * 3️⃣ The Order Success / Confirmation View
     */
    public function success($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('order-success', compact('order'));
    }

    /**
     * 4️⃣ The "Track Order" List Page
     */
    public function myOrders(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $query = Order::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $query->where('order_number', 'LIKE', '%' . $request->search . '%');
        }

        $orders = $query->latest()->get();

        return view('track', compact('orders'));
    }

    /**
     * 5️⃣ The Specific Truck Tracking View (Detail Mode)
     */
    public function track($id)
    {
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        
        return view('track', compact('order'));
    }

    /**
     * 6️⃣ Admin Dashboard Logic
     */
    public function adminDashboard()
    {
        $orders = Order::with(['user', 'items'])->latest()->get();
        
        $todaySales = Order::whereDate('created_at', today())->where('status', 'delivered')->sum('total_amount');
        $todayOrders = Order::whereDate('created_at', today())->count();
        $activeOrders = Order::whereIn('status', ['pending', 'preparing', 'delivering'])->count();

        return view('admin.dashboard', compact('orders', 'todaySales', 'todayOrders', 'activeOrders'));
    }

    /**
     * 7️⃣ Update Status (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,preparing,delivering,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('status', 'Order status updated!');
    }
}