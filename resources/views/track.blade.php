<x-app-layout>
    <div class="min-h-screen bg-[#FDFBF7] py-12">
        <div class="max-w-4xl mx-auto px-4">

            {{-- SECTION A: SEARCH & LIST VIEW --}}
            @if(!isset($order))
                <div class="mb-10">
                    <h1 class="text-4xl font-black text-[#1A1A1A] mb-2 uppercase tracking-tight">Track Your Order</h1>
                    <p class="text-gray-400 font-bold uppercase text-xs tracking-widest">Check your food's journey</p>
                </div>
                
                <div class="bg-white p-2 rounded-[2rem] shadow-xl shadow-orange-100/20 mb-10 border border-gray-50">
                    <form action="{{ route('track') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                        <input type="text" name="search" placeholder="Enter Order Number (e.g. KK123456)" 
                               class="w-full border-none p-5 rounded-2xl font-bold focus:ring-0" 
                               value="{{ request('search') }}">
                        <button type="submit" class="bg-[#E67E00] hover:bg-[#CC7000] text-white px-12 py-5 rounded-2xl font-black uppercase tracking-widest transition-all">
                            Search
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-orange-100/10 border border-gray-50 min-h-[400px]">
                    @if($orders->isEmpty())
                        <div class="h-full flex flex-col items-center justify-center text-center py-20">
                            <div class="bg-gray-50 p-8 rounded-full mb-6 text-4xl">🚚</div>
                            <p class="text-gray-400 font-bold uppercase tracking-widest mb-8">No Orders Found Yet</p>
                            <a href="{{ route('home') }}" class="bg-black text-white px-10 py-5 rounded-[1.5rem] font-black uppercase tracking-widest hover:scale-105 transition-all">
                                Browse Menu
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($orders as $item)
                                <div class="flex items-center justify-between p-6 bg-gray-50 rounded-[1.8rem] hover:bg-orange-50 transition-all border border-transparent hover:border-orange-100 group">
                                    <div>
                                        <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Order ID</span>
                                        <span class="text-lg font-black text-gray-900">{{ $item->order_number }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-block px-3 py-1 rounded-full bg-orange-100 text-[#E67E00] text-[10px] font-black uppercase tracking-widest mb-2">
                                            {{ $item->status }}
                                        </span>
                                        <a href="{{ route('order.track', $item->id) }}" class="block text-black font-black text-sm uppercase tracking-tighter group-hover:translate-x-1 transition-all">
                                            View Status →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            {{-- SECTION B: LIVE TRACKING VIEW --}}
            @else
                <div class="text-center">
                    <div class="mb-10">
                        <a href="{{ route('track') }}" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-[#E67E00]">← Back to my orders</a>
                        <h1 class="text-3xl font-black mt-4 uppercase tracking-tighter text-[#1A1A1A]">Order {{ $order->order_number }}</h1>
                    </div>

                    <div class="bg-white rounded-[3.5rem] p-8 md:p-16 shadow-2xl shadow-orange-100/40 border border-gray-50 mb-8 relative overflow-hidden">
                        
                        @php
                            // Match these exactly with your Admin Dashboard status strings
                            $status = strtolower($order->status);
                            $steps = ['pending', 'preparing', 'ready', 'delivering', 'completed'];
                            $currentIndex = array_search($status, $steps);
                            if($currentIndex === false) $currentIndex = 0; // Fallback

                            // Calculate progress percentage
                            $percentage = ($currentIndex / (count($steps) - 1)) * 100;
                        @endphp

                        {{-- Status Badge --}}
                        <div class="mb-16">
                            <span class="bg-orange-50 text-[#E67E00] px-8 py-3 rounded-full text-xs font-black uppercase tracking-[0.2em] animate-pulse">
                                Currently: {{ $order->status }}
                            </span>
                        </div>

                        {{-- Progress Container --}}
                        <div class="relative px-4 pb-20">
                            {{-- Background Gray Line --}}
                            <div class="absolute left-0 top-5 w-full h-1 bg-gray-100 rounded-full"></div>
                            
                            {{-- Active Orange Line --}}
                            <div class="absolute left-0 top-5 h-1 bg-[#E67E00] rounded-full transition-all duration-1000 ease-in-out shadow-[0_0_15px_rgba(230,126,0,0.4)]" 
                                 style="width: {{ $percentage }}%"></div>

                            {{-- Steps --}}
                            <div class="relative flex justify-between">
                                @php
                                    $icons = ['fa-clipboard-list', 'fa-fire-burner', 'fa-check-double', 'fa-truck-fast', 'fa-house-chimney-check'];
                                    $labels = ['Placed', 'Preparing', 'Ready', 'Delivering', 'Completed'];
                                @endphp

                                @foreach($labels as $index => $label)
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500 {{ $currentIndex >= $index ? 'bg-[#E67E00] text-white scale-110 shadow-lg' : 'bg-white border-2 border-gray-100 text-gray-300' }} z-10">
                                            <i class="fa-solid {{ $icons[$index] }} text-sm"></i>
                                        </div>
                                        <span class="absolute mt-16 text-[10px] font-black uppercase tracking-widest {{ $currentIndex >= $index ? 'text-black' : 'text-gray-300' }}">
                                            {{ $label }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Bottom Info Box --}}
                        <div class="grid md:grid-cols-2 gap-8 border-t border-gray-50 pt-10 text-left">
                            <div>
                                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Delivery To</h3>
                                <p class="font-black text-gray-900 leading-tight mb-1">{{ Auth::user()->name }}</p>
                                <p class="text-gray-500 font-bold text-sm">{{ $order->phone }}</p>
                                <p class="text-gray-400 text-sm mt-2 italic">{{ $order->delivery_address }}</p>
                            </div>
                            <div class="md:text-right">
                                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Order Items</h3>
                                @foreach($order->items as $item)
                                    <p class="text-gray-800 font-bold text-sm">{{ $item->quantity }}x {{ $item->food_name }}</p>
                                @endforeach
                                <p class="mt-4 text-xl font-black text-[#E67E00]">${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- FontAwesome for Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<script>
    // Only run this if we are looking at a specific order (SECTION B)
    @if(isset($order) && $order->status !== 'completed')
        setTimeout(function() {
            window.location.reload();
        }, 10000); // 10000 milliseconds = 10 seconds
    @endif
</script>

</x-app-layout>