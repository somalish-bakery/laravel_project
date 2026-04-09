<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khmer Kitchen - Order Management</title>

    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-khmer { font-family: 'Freehand', cursive; }
        .bg-khmer-orange { background-color: #E67E00; }
        .text-khmer-orange { color: #E67E00; }
        body { background-color: #FDFBF7; font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased">
    
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-khmer-orange rounded-lg flex items-center justify-center text-white font-bold">K</div>
                        <span class="text-xl font-bold text-gray-900">Khmer Kitchen</span>
                    </a>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-khmer-orange font-semibold">Home</a>
                        <a href="{{ route('menu') }}" class="text-gray-600 hover:text-khmer-orange font-semibold">Menu</a>
                        <a href="{{ route('track') }}" class="text-gray-600 hover:text-khmer-orange font-semibold">Track Order</a>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-khmer-orange font-semibold">Contact</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="relative p-2 bg-gray-100 rounded-full">
                        🛒
                        <span class="absolute -top-1 -right-1 bg-khmer-orange text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                    
                    @auth
                        <div class="flex items-center gap-3 ml-4 border-l pl-4">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-xs text-red-500 hover:underline">Logout</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-100 mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold text-khmer-orange mb-4">Khmer Kitchen</h3>
                <p class="text-gray-500 max-w-sm">Bringing the authentic taste of Cambodia to your table with fresh ingredients and traditional recipes.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li><a href="/menu">Our Menu</a></li>
                    <li><a href="/track">Track Order</a></li>
                    <li><a href="/admin/dashboard">Staff Login</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Opening Hours</h4>
                <p class="text-sm text-gray-600">Mon - Sun: 9:00 AM - 9:00 PM</p>
                <div class="mt-4 flex gap-4 text-xl">
                    <span>FB</span> <span>IG</span> <span>TG</span>
                </div>
            </div>
        </div>
        <div class="text-center mt-12 pt-8 border-t text-gray-400 text-xs">
            © 2024 Khmer Kitchen Restaurant. All rights reserved.
        </div>
    </footer>

    @if(session('success'))
        <div class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-2xl shadow-2xl z-[100] animate-bounce">
            {{ session('success') }}
        </div>
    @endif

</body>
</html>