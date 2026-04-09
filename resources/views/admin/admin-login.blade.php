<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Khmer Kitchen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#FDFBF7]">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white p-10 rounded-[2.5rem] shadow-xl w-full max-w-md text-center border border-gray-50">
            
            <div class="w-20 h-20 bg-orange-50 text-[#E67E00] rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-3xl shadow-inner">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>

            <h2 class="text-3xl font-black text-[#1A1A1A] mb-2 uppercase tracking-tight">Admin Login</h2>
            <p class="text-gray-400 text-sm font-bold mb-8 uppercase tracking-widest">Access the restaurant dashboard</p>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 rounded-2xl border border-red-100 text-left">
                    <ul class="text-xs text-red-600 font-black space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                @csrf
                <div class="text-left">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-4 mb-1 block">Username</label>
                    <input type="text" name="username" placeholder="admin" 
                        class="w-full p-5 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none transition-all" required autofocus>
                </div>

                <div class="text-left">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-4 mb-1 block">Password</label>
                    <input type="password" name="password" placeholder="admin123" 
                        class="w-full p-5 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-orange-100 outline-none transition-all" required>
                </div>
                
                <button type="submit"
                    class="w-full bg-[#E67E00] text-white py-5 rounded-[1.5rem] font-black uppercase tracking-widest shadow-xl shadow-orange-100 hover:bg-[#CC7000] transition-all active:scale-[0.98] mt-4">
                    Login
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-gray-50 text-center">
                <p class="text-[10px] text-gray-300 font-black uppercase tracking-[0.2em] mb-2">Internal Demo Access</p>
                <div class="inline-flex gap-4 text-[11px] font-bold text-orange-400">
                    <span>USER: admin</span>
                    <span>PASS: admin123</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>