<?php

use Livewire\Component;
use App\Models\Food;

new class extends Component
{
    public $foods = [];
    public $category = 'All';

    public function mount()
    {
        $this->loadFoods();
    }

    public function setCategory($cat)
    {
        $this->category = $cat;
        $this->loadFoods();
    }

    public function loadFoods()
    {
        if ($this->category === 'All') {
            $this->foods = Food::all();
        } else {
            $this->foods = Food::where('category', $this->category)->get();
        }
    }
};
?>

<div class="max-w-7xl mx-auto px-4 py-12">
    
    <div class="flex flex-wrap justify-center gap-3 mb-16">
        @foreach(['All', 'Rice Dishes', 'Noodles', 'Soups', 'Drinks', 'Desserts'] as $cat)
            <button 
                wire:click="setCategory('{{ $cat }}')"
                class="px-6 py-2.5 rounded-full font-black transition-all duration-300 shadow-sm border-2 whitespace-nowrap text-sm md:text-base
                {{ $category == $cat 
                    ? 'bg-[#E67E00] text-white border-[#E67E00] scale-105' 
                    : 'bg-white text-gray-400 border-gray-100 hover:border-orange-200' }}">
                {{ $cat }}
            </button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
        @foreach($foods as $item)
            <div class="bg-white rounded-[2.5rem] p-5 shadow-sm border border-gray-50 flex flex-col h-full relative group transition-all duration-500 hover:shadow-orange-100/50">
                
                @if($item->is_popular)
                    <div class="absolute top-8 left-8 z-10 bg-[#E67E00] text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                        ★ Popular
                    </div>
                @endif

                <div class="overflow-hidden rounded-[2rem] mb-6 aspect-[4/3]">
                    <img src="{{ asset($item->image) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                </div>

                <div class="px-1 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-2 gap-2">
                        <h3 class="text-lg lg:text-xl font-black text-gray-900 leading-tight">{{ $item->name }}</h3>
                        <span class="text-[#E67E00] font-black text-lg lg:text-xl whitespace-nowrap">${{ number_format($item->price, 2) }}</span>
                    </div>
                    
                    <p class="text-orange-400 font-bold text-[10px] lg:text-xs mb-3">{{ $item->khmer_name }}</p>
                    
                    <p class="text-gray-400 text-xs lg:text-sm mb-6 font-medium leading-relaxed line-clamp-2">
                        {{ $item->description }}
                    </p>

                    <div class="mt-auto"> 
                        <button 
                            onclick='showCustomizeModal(@json($item))'
                            class="w-full bg-[#E67E00] text-white py-3.5 rounded-2xl font-black hover:bg-orange-600 transition-all shadow-md active:scale-95 text-sm lg:text-base">
                            Add to Basket
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="customModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-md" onclick="closeModal()"></div>
        
        <div class="bg-white rounded-[3rem] w-full max-w-lg relative z-10 overflow-hidden shadow-2xl">
            <form action="" id="modalForm" method="POST">
                @csrf
                <div class="p-8 md:p-10">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h2 id="modalFoodName" class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight"></h2>
                            <p id="modalFoodKhmer" class="text-[#E67E00] font-bold text-base md:text-lg"></p>
                        </div>
                        <button type="button" onclick="closeModal()" class="bg-gray-100 p-2 rounded-full text-gray-400 hover:bg-gray-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] mb-4">Choose Spicy Level</label>
                        <select name="spicy" class="w-full bg-gray-50 border-none rounded-2xl p-5 font-bold focus:ring-2 focus:ring-orange-100 transition-all outline-none appearance-none">
                            <option value="Not Spicy">Not Spicy 😊</option>
                            <option value="Medium">Medium 🔥</option>
                            <option value="Extra Spicy">Extra Spicy 🔥🔥🔥</option>
                        </select>
                    </div>

                    <div class="mb-10 flex items-center justify-between bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
                        <div>
                            <span class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] mb-1">Total Price</span>
                            <span id="modalTotalPrice" class="text-2xl font-black text-[#E67E00] tracking-tighter"></span>
                        </div>

                        <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                            <button type="button" onclick="changeQty(-1)"
                                class="w-10 h-10 flex items-center justify-center font-black text-gray-400 hover:text-orange-500 transition-all text-xl">-</button>
                            
                            <input type="number" id="quantity_input" name="quantity" value="1"
                                readonly class="w-10 text-center font-black text-xl text-gray-900 bg-transparent border-none p-0 focus:ring-0">

                            <button type="button" onclick="changeQty(1)"
                                class="w-10 h-10 flex items-center justify-center font-black text-gray-400 hover:text-orange-500 transition-all text-xl">+</button>
                        </div>
                    </div>

                    <input type="hidden" id="base_price_hidden" value="0">

                    <button type="submit" class="w-full bg-[#E67E00] hover:bg-orange-600 text-white py-5 rounded-[1.5rem] font-black text-lg md:text-xl shadow-xl transition-all active:scale-[0.98]">
                        Add to My Basket
                    </button>
                </div>
            </form>
        </div>
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
    let total = qty * basePrice;
    document.getElementById('modalTotalPrice').innerText = '$' + total.toFixed(2);
}

function closeModal() {
    document.getElementById('customModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>