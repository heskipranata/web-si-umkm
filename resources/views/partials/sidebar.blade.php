<div id="cartSidebar"
    class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <div class="flex justify-between items-center px-4 py-3 border-b">
        <h3 class="text-xl font-bold text-green-700">Keranjang</h3>
        <button onclick="toggleCart()" class="text-gray-500 hover:text-red-600 text-xl">&times;</button>
    </div>
    <div id="cartItems" class="p-4 space-y-4 overflow-y-auto h-[calc(100%-200px)]"></div>
    <div class="p-4 border-t">
        <div class="flex justify-between text-lg font-semibold mb-4">
            <span>Total:</span>
            <span id="cartTotal">Rp0</span>
        </div>

        <form action="{{ route('checkout') }}" method="GET">
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded">Pesan Sekarang</button>
        </form>

    </div>
