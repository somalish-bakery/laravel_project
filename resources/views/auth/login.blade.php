<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-[#FDFBF7] px-4 py-10">
        
        <div class="text-center mb-8">
            <div class="flex justify-center mb-2">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9C5 12.87 8.13 16 12 16C15.87 16 19 12.87 19 9C19 5.13 15.87 2 12 2ZM12 14C9.24 14 7 11.76 7 9C7 6.24 9.24 4 12 4C14.76 4 17 6.24 17 9C17 11.76 14.76 14 12 14Z" fill="#E67E00"/>
                    <path d="M12 18C7.58 18 4 21.58 4 26H6C6 22.69 8.69 20 12 20C15.31 20 18 22.69 18 26H20C20 21.58 16.42 18 12 18Z" fill="#E67E00"/>
                </svg>
            </div>
            <h1 class="text-3xl font-black text-[#1A1A1A] uppercase tracking-tight">Khmer Kitchen</h1>
            <p class="text-[#E67E00] font-bold text-lg">ភោជនីយដ្ឋានខ្មែរ</p>
            <p class="text-gray-400 text-sm font-bold mt-2 uppercase tracking-widest">Digital Ordering System</p>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl w-full max-w-md border border-gray-50">
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 rounded-2xl border border-red-100">
                    <ul class="list-none text-xs text-red-600 font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex bg-gray-100 rounded-2xl p-1 mb-8">
                <button id="loginBtn" onclick="toggleAuth('login')" 
                    class="flex-1 py-3 rounded-xl transition-all duration-200 text-sm font-black bg-white shadow-sm text-black uppercase tracking-widest">
                    Login
                </button>
                <button id="registerBtn" onclick="toggleAuth('register')" 
                    class="flex-1 py-3 rounded-xl transition-all duration-200 text-sm font-black text-gray-400 uppercase tracking-widest">
                    Register
                </button>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Phone Number</label>
                    <input type="text" name="phone" value="012345678" required
                        class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 font-bold focus:ring-2 focus:ring-orange-100 transition outline-none">
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Password</label>
                    <input type="password" name="password" value="demo123" required
                        class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 font-bold focus:ring-2 focus:ring-orange-100 transition outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-[#E67E00] hover:bg-[#CC7000] text-white font-black py-5 rounded-[1.5rem] mt-4 shadow-xl shadow-orange-100 transition-all active:scale-[0.98]">
                    SIGN IN
                </button>
            </form>

            <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-5 hidden">
                @csrf
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required
                        class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 font-bold focus:ring-2 focus:ring-orange-100 outline-none transition">
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Phone Number *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="012345678" required
                        class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 font-bold focus:ring-2 focus:ring-orange-100 outline-none transition">
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Password *</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 font-bold focus:ring-2 focus:ring-orange-100 outline-none transition">
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Delivery Address (Optional)</label>
                    <textarea name="address" rows="2" placeholder="e.g. Street 200, Phnom Penh"
                        class="w-full bg-gray-50 border-none rounded-2xl p-4 mt-1 font-bold focus:ring-2 focus:ring-orange-100 outline-none transition">{{ old('address') }}</textarea>
                </div>

                <button type="submit"
                    class="w-full bg-[#E67E00] hover:bg-[#CC7000] text-white font-black py-5 rounded-[1.5rem] mt-4 shadow-xl shadow-orange-100 transition-all active:scale-[0.98]">
                    CREATE ACCOUNT
                </button>
            </form>

            <div id="demoBox" class="mt-8 pt-6 border-t border-gray-50 text-center">
                <p class="text-[10px] text-gray-300 font-black uppercase tracking-[0.2em] mb-2">Internal Demo Access</p>
                <div class="inline-flex gap-4 text-[11px] font-bold text-orange-400">
                    <span>TEL: 012345678</span>
                    <span>PASS: demo123</span>
                </div>
            </div>
        </div>

        <p class="mt-8 text-gray-400 text-[10px] font-bold uppercase tracking-widest text-center leading-loose">
            By continuing, you agree to our <br>
            <span class="text-gray-600 underline cursor-pointer">Terms of Service</span> & <span class="text-gray-600 underline cursor-pointer">Privacy Policy</span>
        </p>
    </div>

    <script>
        function toggleAuth(mode) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginBtn = document.getElementById('loginBtn');
            const registerBtn = document.getElementById('registerBtn');
            const demoBox = document.getElementById('demoBox');

            if (mode === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                demoBox.classList.remove('hidden');
                
                loginBtn.classList.add('bg-white', 'shadow-sm', 'text-black');
                loginBtn.classList.remove('text-gray-400');
                registerBtn.classList.remove('bg-white', 'shadow-sm', 'text-black');
                registerBtn.classList.add('text-gray-400');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                demoBox.classList.add('hidden');
                
                registerBtn.classList.add('bg-white', 'shadow-sm', 'text-black');
                registerBtn.classList.remove('text-gray-400');
                loginBtn.classList.remove('bg-white', 'shadow-sm', 'text-black');
                loginBtn.classList.add('text-gray-400');
            }
        }

        // --- THE FIX ---
        // 1. Switch to register if there are validation errors from a registration attempt
        // 2. Or if the URL is /register
        window.onload = function() {
            @if($errors->has('name') || $errors->has('address') || request()->is('register*'))
                toggleAuth('register');
            @endif
        }
    </script>
</x-guest-layout>