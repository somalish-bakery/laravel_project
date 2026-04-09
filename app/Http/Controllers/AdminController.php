<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Note: Security check is now handled in web.php to avoid Laravel 11 errors.

    public function index(Request $request)
    {
        // 1. Get filtered orders
        $query = Order::with(['items'])->latest();
        if ($request->has('status') && $request->status != 'All') {
            $query->where('status', strtolower($request->status));
        }
        $orders = $query->get();

        // 2. Dashboard Statistics
        $todaySales = Order::whereDate('created_at', Carbon::today())
                            ->where('status', 'completed')
                            ->sum('total_amount');

        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();

        $activeOrders = Order::whereIn('status', ['pending', 'preparing', 'ready', 'delivering'])->count();

        $completedToday = Order::whereDate('created_at', Carbon::today())
                                ->where('status', 'completed')
                                ->count();

        return view('admin.dashboard', compact('orders', 'todaySales', 'todayOrders', 'activeOrders', 'completedToday'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = strtolower($request->status); 
        $order->save();

        return back()->with('success', 'Status updated successfully!');
    }
}