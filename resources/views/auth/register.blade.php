<x-guest-layout>
    <div class="min-h-screen bg-[#FFFBEB] flex flex-col items-center justify-center p-4">
        
        <div class="mb-8 text-center">
            <div class="flex justify-center mb-4">
                <div class="bg-white p-3 rounded-2xl shadow-sm">
                    <x-application-logo class="w-12 h-12 fill-current text-[#E67E00]" />
                </div>
            </div>
            <h1 class="text-2xl font-black text-gray-900">Khmer Kitchen</h1>
            <p class="text-gray-500 text-sm font-bold mt-1">Login or create an account to start ordering</p>
        </div>

        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-xl p-8 border border-gray-100">
            
            <div class="flex bg-gray-100 p-1 rounded-2xl mb-8">
                <a href="{{ route('login') }}" class="flex-1 py-3 text-center text-sm font-bold text-gray-500 hover:text-gray-700 transition-all">Login</a>
                <div class="flex-1 py-3 text-center text-sm font-black text-gray-900 bg-white rounded-xl shadow-sm">Register</div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none" required autofocus>
                    <x-input-error :messages="$errors->get('name')" class="mt-1 ml-1" />
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Phone Number *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+855 12 345 678" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none" required>
                    <x-input-error :messages="$errors->get('phone')" class="mt-1 ml-1" />
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Email (Optional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="your.email@example.com" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 ml-1" />
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Password *</label>
                    <input type="password" name="password" placeholder="Create a password" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 ml-1" />
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-400 tracking-widest mb-2 ml-1">Default Address (Optional)</label>
                    <textarea name="address" rows="2" placeholder="Your delivery address for easier checkout" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-1 ml-1" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#E67E00] hover:bg-orange-600 text-white py-4 rounded-[1.25rem] font-black text-lg transition-all shadow-lg shadow-orange-100 active:scale-[0.98]">
                        Create Account
                    </button>
                </div>

                <p class="text-[10px] text-gray-400 font-bold uppercase text-center mt-6 tracking-widest leading-relaxed">
                    By continuing, you agree to our <br> 
                    <a href="#" class="text-gray-600 underline">Terms of Service</a> and <a href="#" class="text-gray-600 underline">Privacy Policy</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>