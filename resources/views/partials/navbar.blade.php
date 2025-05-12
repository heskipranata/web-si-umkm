<nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50 mx-3 md:mx-4 rounded mt-2 py-3">
    <div class="container mx-auto flex items-center justify-between px-4">
        <!-- Logo Gambar Horizontal -->
        <a href="{{ url('/#home') }}" class="flex items-center">
            <img src="{{ asset('images/makanjo-icon.png') }}" alt="Makanjo Logo" class="h-10 md:h-14 object-contain">
            <!-- Ganti dengan path ke ikon horizontal -->
        </a>

        <!-- Tombol Toggle untuk Mobile -->
        <button class="md:hidden text-2xl focus:outline-none" @click="open = !open">
            ☰
        </button>

        <!-- Navigasi Menu -->
        <div class="hidden md:flex space-x-6 items-center">
            <a href="{{ url('/#home') }}" class="text-gray-700 font-medium hover:text-primary">Beranda</a>
            <a href="{{ url('/#tentang') }}" class="text-gray-700 font-medium hover:text-primary">Tentang</a>
            <a href="{{ url('/#menu') }}" class="text-gray-700 font-medium hover:text-primary">Menu</a>
            <a href="{{ url('/#kontak') }}" class="text-gray-700 font-medium hover:text-primary">Kontak</a>
            <a href="javascript:void(0)" id="cart-button" class="relative text-green-500 hover:text-primary">
                <!-- Ikon keranjang -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h14l-1.5 8h-13L5 6h15M7 13L5 6m2 7l1 5m6-5l1 5" />
                </svg>

                <!-- 🔴 Badge jumlah item -->
                <span id="cart-count"
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-sm font-bold px-1.5 rounded-full hidden">0</span>
            </a>
        </div>
    </div>
</nav>
