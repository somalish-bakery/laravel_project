<x-app-layout>
    <div class="p-8 bg-gray-50 min-h-screen">
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="text-gray-500 font-medium">Manage incoming orders for Khmer Kitchen</p>
            </div>

            {{-- Admin Logout Button --}}
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 rounded-xl hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-all font-bold text-sm shadow-sm text-gray-700">
                    <span>Admin Logout</span> 
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                </button>
            </form>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex items-center gap-5">
                <div class="w-14 h-14 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center text-2xl font-bold">$</div>
                <div>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Today's Sales</p>
                    <p class="text-2xl font-black text-[#00A651]">${{ number_format($todaySales, 2) }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-2xl">📦</div>
                <div>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Today's Orders</p>
                    <p class="text-2xl font-black text-blue-600">{{ $todayOrders }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex items-center gap-5">
                <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-2xl">🔥</div>
                <div>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Active Orders</p>
                    <p class="text-2xl font-black text-orange-600">{{ $activeOrders }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex items-center gap-5">
                <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center text-2xl">✅</div>
                <div>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Completed Today</p>
                    <p class="text-2xl font-black text-purple-600">{{ $completedToday }}</p>
                </div>
            </div>
        </div>

        {{-- Orders Table Section --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-50">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Recent Orders</h2>
                <div class="flex gap-1 bg-gray-100 p-1.5 rounded-2xl">
                    @foreach(['All', 'Pending', 'Preparing', 'Ready', 'Delivering', 'Completed'] as $pill)
                        <a href="?status={{ $pill }}" 
                           class="px-4 py-2 rounded-xl text-[10px] font-black uppercase transition-all {{ (request('status', 'All')) == $pill ? 'bg-white shadow-sm text-orange-600' : 'text-gray-500 hover:text-gray-700' }}">
                             {{ $pill }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase tracking-widest border-b border-gray-50">
                            <th class="pb-4">Order ID</th>
                            <th class="pb-4">Customer</th>
                            <th class="pb-4 text-center">Total</th>
                            <th class="pb-4 text-center">Payment</th>
                            <th class="pb-4 text-center">Status</th>
                            <th class="pb-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="py-6 font-black text-gray-900 text-sm">#{{ $order->order_number }}</td>
                            <td>
                                <p class="font-black text-sm text-gray-800">{{ $order->name ?? 'Guest' }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $order->phone }}</p>
                            </td>
                            <td class="text-center font-black text-sm text-[#E67E00]">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="text-center">
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[9px] font-black uppercase tracking-tighter">
                                    {{ $order->payment_method }}
                                </span>
                            </td>
                            <td class="text-center">
                                @php
                                    $statusColor = match(strtolower($order->status)) {
                                        'completed' => 'bg-green-50 text-green-600',
                                        'delivering' => 'bg-orange-50 text-orange-600',
                                        'pending' => 'bg-yellow-50 text-yellow-600',
                                        default => 'bg-gray-50 text-gray-500',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase {{ $statusColor }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-right">
                                <form action="{{ route('admin.order.status', $order->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-[10px] font-black uppercase border-gray-100 rounded-xl bg-gray-50 focus:ring-orange-200 outline-none cursor-pointer">
                                        <option value="" disabled selected>Update</option>
                                        <option value="pending">Pending</option>
                                        <option value="preparing">Preparing</option>
                                        <option value="ready">Ready</option>
                                        <option value="delivering">Delivering</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-24">
                                <p class="text-gray-300 font-black uppercase tracking-[0.2em] text-sm">No Orders Found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>