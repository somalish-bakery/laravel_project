<x-app-layout>
    <x-nav />
    
    <div class="relative h-[600px] flex items-center justify-center text-center text-white">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img src="/images/hero-bg.jpg" class="absolute inset-0 w-full h-full object-cover" onerror="this.src='https://placehold.co/1200x600?text=Khmer+Kitchen+Hero'">
        
        <div class="relative z-20 px-4">
            <h1 class="text-5xl md:text-7xl font-bold mb-4">Welcome to Khmer Kitchen</h1>
            <p class="text-2xl text-[#E67E00] font-khmer mb-6">ស្វាគមន៍មកកាន់ភោជនីយដ្ឋានខ្មែរ</p>
            <p class="text-lg mb-8 text-gray-200">Authentic Cambodian Cuisine delivered to your doorstep</p>
            <a href="{{ route('menu') }}" class="bg-[#E67E00] hover:bg-orange-600 text-white px-10 py-4 rounded-full text-xl font-bold transition flex items-center mx-auto w-fit shadow-lg">
                Order Now <span class="ml-2">→</span>
            </a>
        </div>
    </div>

    <section class="py-20 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-black mb-12 text-gray-900">Featured Dishes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredDishes as $food)
                    <div class="bg-white rounded-[2.5rem] p-5 shadow-sm relative group border border-transparent hover:border-orange-200 transition-all duration-300 flex flex-col h-full">
                        <span class="absolute top-8 right-8 bg-[#E67E00] text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest z-10 shadow-lg">
                            ★ Popular
                        </span>
                        
                        <div class="overflow-hidden rounded-[2rem] mb-6">
                            <img src="{{ asset($food->image) }}" 
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700"
                                 onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                        </div>

                        <div class="flex flex-col flex-grow text-left px-2">
                            <h3 class="text-2xl font-black text-gray-900 leading-tight">{{ $food->name }}</h3>
                            <p class="text-orange-400 font-bold text-sm mb-3">{{ $food->khmer_name }}</p>
                            <p class="text-gray-400 text-sm mb-6 font-medium leading-relaxed line-clamp-2">
                                {{ $food->description }}
                            </p>
                            
                            <div class="flex justify-between items-center mt-auto">
                                <span class="text-[#E67E00] font-black text-2xl tracking-tighter">
                                    ${{ number_format($food->price, 2) }}
                                </span>
                                <button onclick='showCustomizeModal(@json($food))' 
                                        class="bg-[#E67E00] text-white px-8 py-3 rounded-2xl font-black hover:bg-orange-600 transition-all shadow-md active:scale-95">
                                    Order Now
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-16">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6 text-4xl">🍜</div>
                    <h3 class="text-xl font-bold mb-2">Authentic Recipes</h3>
                    <p class="text-gray-500">Traditional Khmer recipes prepared by experienced chefs</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6 text-4xl">🚚</div>
                    <h3 class="text-xl font-bold mb-2">Fast Delivery</h3>
                    <p class="text-gray-500">Quick and reliable delivery to your location</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6 text-4xl">🌿</div>
                    <h3 class="text-xl font-bold mb-2">Fresh Ingredients</h3>
                    <p class="text-gray-500">Only the freshest, locally-sourced ingredients used</p>
                </div>
            </div>
        </div>
    </section>

    <div id="customModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-md" onclick="closeModal()"></div>
        <div class="bg-white rounded-[3rem] w-full max-w-lg relative z-10 overflow-hidden shadow-2xl">
            <form action="" id="modalForm" method="POST">
                @csrf
                <div class="p-10">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h2 id="modalFoodName" class="text-3xl font-black text-gray-900"></h2>
                            <p id="modalFoodKhmer" class="text-[#E67E00] font-bold text-lg"></p>
                        </div>
                        <button type="button" onclick="closeModal()" class="bg-gray-50 p-2 rounded-full text-gray-400 hover:bg-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] mb-4">Choose Spicy Level</label>
                        <select name="spicy" class="w-full bg-gray-50 border-none rounded-2xl p-5 font-bold outline-none appearance-none">
                            <option value="Not Spicy">Not Spicy 😊</option>
                            <option value="Medium">Medium 🔥</option>
                            <option value="Extra Spicy">Extra Spicy 🔥🔥🔥</option>
                        </select>
                    </div>

                    <div class="mb-10 flex items-center justify-between bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
                        <div>
                            <span class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Total</span>
                            <span id="modalTotalPrice" class="text-2xl font-black text-[#E67E00]"></span>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="button" onclick="changeQty(-1)" class="w-12 h-12 bg-white rounded-xl shadow-sm font-black text-xl text-gray-400 border border-gray-100">-</button>
                            <input type="number" id="quantity_input" name="quantity" value="1" readonly class="w-10 text-center font-black text-xl bg-transparent border-none">
                            <button type="button" onclick="changeQty(1)" class="w-12 h-12 bg-white rounded-xl shadow-sm font-black text-xl text-gray-400 border border-gray-100">+</button>
                        </div>
                    </div>

                    <input type="hidden" id="base_price_hidden" value="0">
                    <button type="submit" class="w-full bg-[#E67E00] hover:bg-orange-600 text-white py-6 rounded-[1.5rem] font-black text-xl shadow-xl transition-all active:scale-[0.98]">
                        Add to My Basket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentPrice = 0;

        function showCustomizeModal(food) {
            currentPrice = parseFloat(food.price);
            document.getElementById('modalFoodName').innerText = food.name;
            document.getElementById('modalFoodKhmer').innerText = food.khmer_name;
            document.getElementById('modalForm').action = "/cart/add/" + food.id;
            document.getElementById('quantity_input').value = 1;
            document.getElementById('base_price_hidden').value = currentPrice;
            updateTotal();
            document.getElementById('customModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function changeQty(amount) {
            let qtyInput = document.getElementById('quantity_input');
            let qty = parseInt(qtyInput.value) + amount;
            if (qty < 1) qty = 1;
            qtyInput.value = qty;
            updateTotal();
        }

        function updateTotal() {
            let qty = parseInt(document.getElementById('quantity_input').value);
            let basePrice = parseFloat(document.getElementById('base_price_hidden').value);
            document.getElementById('modalTotalPrice').innerText = '$' + (qty * basePrice).toFixed(2);
        }

        function closeModal() {
            document.getElementById('customModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-app-layout>