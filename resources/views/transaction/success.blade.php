@include('partials.header')
@include('partials.navbar')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-center px-4">
    <!-- Icon -->
    <div class="bg-green-100 p-6 rounded-full mb-6">
        <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
        </svg>
    </div>

    <!-- Text -->
    <h2 class="text-2xl font-bold text-green-700 mb-2">Terima Kasih!</h2>
    <p class="text-gray-700 mb-6">Pesanan Anda telah berhasil diproses. Silakan datang kembali!</p>

    <!-- Button -->
    <a href="{{ url('/') }}"
       class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 transition duration-200">
        Kembali ke Home
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        localStorage.removeItem('cart');
    });
</script>
