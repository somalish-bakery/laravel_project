<x-app-layout>
    <div class="bg-[#FDFBF7] pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-black text-gray-900 mb-2 tracking-tight">Our Menu</h1>
            <p class="text-[#E67E00] font-medium text-2xl tracking-wide">ម៉ឺនុយរបស់យើង</p>
        </div>
    </div>

    <div class="bg-[#FDFBF7] min-h-screen pb-20">
        @livewire('food-menu')
    </div>

    <script>
        function changeQty(amount) {
            let qtyInput = document.getElementById('quantity_input');
            if (qtyInput) {
                let current = parseInt(qtyInput.value);
                if (current + amount >= 1) {
                    qtyInput.value = current + amount;
                }
            }
        }
    </script>
</x-app-layout>