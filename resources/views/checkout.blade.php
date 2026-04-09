<x-app-layout>
    <div class="bg-[#F8F9FA] min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4">
            
            <h1 class="text-3xl font-black text-gray-900 mb-8">Checkout</h1>

            <form action="{{ route('order.place') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <h2 class="text-xl font-black text-gray-900 mb-6">Customer Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Full Name</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" 
                                        class="w-full p-4 bg-gray-100 border-none rounded-2xl font-bold text-gray-500 outline-none cursor-not-allowed" readonly>
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Phone Number</label>
                                    <input type="text" name="phone" value="{{ auth()->user()->phone }}" 
                                        class="w-full p-4 bg-gray-100 border-none rounded-2xl font-bold text-gray-500 outline-none cursor-not-allowed" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <h2 class="text-xl font-black text-gray-900 mb-6">Delivery Details</h2>
                            
                            <div class="space-y-4 mb-6">
                                <label class="flex items-center p-4 bg-orange-50 rounded-2xl border-2 border-orange-500 transition-all cursor-pointer">
                                    <input type="radio" name="order_type" value="Delivery" class="w-5 h-5 text-orange-500 focus:ring-orange-500 border-gray-300" checked>
                                    <div class="ml-4">
                                        <span class="block font-black text-gray-900">🚚 Standard Delivery</span>
                                        <span class="block text-xs text-orange-600 font-bold uppercase tracking-tight">45-60 minutes • $2.00 fee</span>
                                    </div>
                                </label>
                            </div>

                            <div>
                                <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Delivery Address</label>
                                <textarea name="address" rows="2" 
                                    class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none" 
                                    placeholder="Enter address if different from profile" required>{{ auth()->user()->address }}</textarea>
                                <p class="mt-2 ml-1 text-[10px] text-gray-400 font-bold uppercase tracking-wide">We'll use your saved address by default</p>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <h2 class="text-xl font-black text-gray-900 mb-6">Payment Method</h2>
                            <div class="space-y-4">
                                <label class="flex items-center p-4 bg-gray-50 rounded-2xl border-2 border-transparent has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 transition-all cursor-pointer">
                                    <input type="radio" name="payment_method" value="COD" checked class="w-5 h-5 text-orange-500 border-gray-300 focus:ring-orange-500">
                                    <div class="ml-4 flex items-center gap-2">
                                        <span class="text-xl">💵</span>
                                        <span class="block font-black text-gray-900">Cash on Delivery</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 sticky top-8">
                            <h2 class="text-xl font-black text-gray-900 mb-6">Order Summary</h2>
                            
                            <div class="space-y-4 mb-6">
                                @forelse($cartItems as $id => $details)
                                <div class="flex justify-between items-center text-sm font-bold text-gray-600">
                                    <div class="flex flex-col">
                                        <span>{{ $details['quantity'] }}x {{ $details['name'] }}</span>
                                        @if(isset($details['spicy']))
                                            <span class="text-[10px] text-orange-500 uppercase">Spicy: {{ $details['spicy'] }}</span>
                                        @endif
                                    </div>
                                    <span>${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <p class="text-gray-400 text-sm font-bold tracking-tight">Your basket is empty</p>
                                </div>
                                @endforelse
                            </div>

                            <hr class="border-gray-50 mb-6">

                            <div class="space-y-3 mb-8">
                                <div class="flex justify-between text-gray-400 font-bold text-sm uppercase tracking-tight">
                                    <span>Subtotal:</span>
                                    <span class="text-gray-900">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-400 font-bold text-sm uppercase tracking-tight">
                                    <span>Delivery Fee:</span>
                                    <span class="text-gray-900">$2.00</span>
                                </div>
                                <div class="flex justify-between pt-4 border-t border-gray-50">
                                    <span class="text-xl font-black text-gray-900">Total:</span>
                                    <span class="text-2xl font-black text-[#E67E00] tracking-tighter">${{ number_format($subtotal + 2, 2) }}</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-[#E67E00] hover:bg-orange-600 text-white py-5 rounded-[1.5rem] font-black text-lg shadow-xl shadow-orange-100 transition-all active:scale-[0.98]">
                                Place Order
                            </button>

                            <p class="text-[10px] text-gray-400 font-bold uppercase text-center mt-6 tracking-widest leading-relaxed">
                                Fast & Secure Checkout <br> Powered by Khmer Kitchen
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>