<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#FDFBF7] px-4">
        <div class="max-w-md w-full bg-white rounded-[3rem] p-10 shadow-xl text-center border border-gray-100">
            <div class="w-24 h-24 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-8 text-5xl">
                ✓
            </div>

            <h1 class="text-3xl font-bold mb-2 text-gray-900">Order Placed!</h1>
            <p class="text-gray-500 mb-8">Your delicious Khmer meal is being prepared by our chefs.</p>

            <div class="bg-gray-50 rounded-[2rem] p-6 mb-8 text-left">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-400 text-sm font-bold uppercase tracking-tight">Order Number</span>
                    <span class="font-black text-black">{{ $order->order_number }}</span>
                </div>
                
                <div class="flex justify-between mb-2">
                    <span class="text-gray-400 text-sm font-bold uppercase tracking-tight">Payment Method</span>
                    <span class="font-black text-black uppercase">{{ $order->payment_method }}</span>
                </div>

                <div class="flex justify-between border-t border-gray-200 pt-4 mt-2">
                    <span class="font-black text-sm uppercase">Total Paid</span>
                    <span class="font-black text-[#E67E00] text-lg">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('order.track', $order->id) }}" 
                   class="block w-full bg-black text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-gray-800 transition shadow-lg active:scale-95">
                    Track My Order
                </a>
                
                <a href="{{ route('home') }}" 
                   class="block w-full text-gray-400 font-bold uppercase text-xs tracking-widest hover:text-black transition py-2">
                    Back to Home
                </a>
            </div>

            <p class="mt-8 text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">
                *Estimated preparation time: 20-30 minutes
            </p>
        </div>
    </div>
</x-app-layout>