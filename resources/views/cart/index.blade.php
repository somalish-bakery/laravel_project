<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 min-h-screen">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-gray-900">Your Basket</h2>
            <a href="{{ route('menu') }}" class="text-sm font-bold text-gray-400 hover:text-[#E67E00] transition-colors">+ Add More Items</a>
        </div>
        
        @if(session('cart') && count(session('cart')) > 0)
            @php $total = 0; @endphp
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                <div class="space-y-6">
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-gray-50 pb-6 last:border-none last:pb-0">
                            <div class="flex items-center gap-6 w-full">
                                <img src="{{ filter_var($details['image'], FILTER_VALIDATE_URL) ? $details['image'] : asset('storage/' . $details['image']) }}" 
                                     class="w-24 h-24 rounded-[1.5rem] object-cover shadow-sm">
                                
                                <div>
                                    <h4 class="font-bold text-xl text-gray-900">{{ $details['name'] }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-2 py-0.5 bg-orange-50 text-[#E67E00] text-[10px] font-black uppercase rounded-md tracking-wider">
                                            Spicy: {{ $details['spicy'] }}
                                        </span>
                                    </div>
                                    <p class="text-gray-400 text-sm mt-2 font-medium">${{ number_format($details['price'], 2) }} each</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between md:justify-end gap-10 w-full md:w-auto">
                                <div class="flex items-center bg-gray-50 rounded-2xl px-5 py-2 border border-gray-100">
                                    <span class="font-black text-gray-900">x{{ $details['quantity'] }}</span>
                                </div>
                                
                                <div class="text-right min-w-[80px]">
                                    <span class="font-black text-xl text-[#E67E00] tracking-tight">
                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </span>
                                </div>

                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-2">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 p-8 bg-[#FDFBF7] rounded-[2rem] border border-orange-50">
                    <div class="flex justify-between mb-3 text-gray-500 font-medium">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-5 text-gray-500 font-medium">
                        <span>Delivery Fee</span>
                        <span class="text-green-600 font-bold">Free</span>
                    </div>
                    <div class="flex justify-between text-2xl font-black border-t border-orange-100 pt-6 mt-2">
                        <span class="text-gray-900">Total Amount</span>
                        <span class="text-[#E67E00] tracking-tighter">${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <a href="{{ route('checkout') }}" class="block w-full text-center bg-[#E67E00] hover:bg-orange-600 text-white py-6 rounded-[1.5rem] font-black text-lg mt-8 shadow-xl shadow-orange-100 transition-all active:scale-[0.98]">
                    Proceed to Checkout
                </a>
            </div>
        @else
            <div class="bg-white rounded-[2.5rem] p-20 text-center shadow-sm border border-gray-50">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-50 rounded-full mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your basket is empty</h2>
                <p class="text-gray-400 mb-10">Looks like you haven't added anything to your order yet.</p>
                <a href="{{ route('menu') }}" class="bg-black text-white px-12 py-4 rounded-2xl font-bold hover:bg-[#E67E00] transition-all">
                    Start Ordering
                </a>
            </div>
        @endif
    </div>
</x-app-layout>