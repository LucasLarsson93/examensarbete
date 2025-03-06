<header class="text-white">
    <div class="container mx-auto flex items-center justify-between p-4">
        <!-- Logo -->
        <div class="flex items-center">
            <svg class="h-10 w-auto text-white" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="..." fill="currentColor"/>
            </svg>
        </div>

        <button id="menu-btn" class="lg:hidden focus:outline-none">
            <svg class="w-8 h-8 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Navigation Links -->
        <nav id="menu" class="hidden flex-col mb-4 space-y-4 absolute top-16 left-0 w-full p-4 bg-white lg:flex lg:flex-row lg:relative lg:top-0 lg:bg-transparent lg:space-y-0 lg:space-x-4 lg:p-0">
            <a href="/" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Home</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Register</a>
                    @endif
                @endauth
            @endif
            <a href="{{ route('privacy-policy') }}" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Privacy Policy</a>
            <a href="{{ route('terms-of-service') }}" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Terms of Service</a>
            <a href="{{ route('shop') }}" class="px-4 py-2 rounded text-sm font-medium bg-white text-gray-900 hover:text-[#FF2D20]">Shop</a>
        </nav>
    </div>
</header>
<script>
    document.getElementById("menu-btn").addEventListener("click", function () {
        document.getElementById("menu").classList.toggle("hidden");
    });
</script>
