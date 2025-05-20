<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Penjualan Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/script.js', 'resources/js/admin'])
    <style>
        .modal {
            display: none;
        }

        .modal.active {
            display: flex;
        }
    </style>
</head>

<body class="bg-white font-sans text-gray-900 min-h-screen flex">
    <aside class="w-64 bg-green-700 text-white flex flex-col">
        <!-- Sidebar content -->
        <div class="p-6 font-bold text-3xl tracking-wider border-b border-green-600 select-none">
            <img src="{{ asset('images/makanjo-icon.png') }}" alt="Makanjo Logo" class="md:h-14 object-contain">
        </div>
        <nav class="flex-1 flex flex-col mt-6 space-y-1 px-4">
            <a data-tab="dashboard"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors active:bg-green-800"
                href="{{ route('dashboard') }}">
                <!-- icon -->
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h18v18H3V3z"></path>
                </svg>
                Dashboard Utama
            </a>
            <a data-tab="transactions"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors"
                href="{{ route('admin.transaction') }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M13 16h-1v-4h-1"></path>
                    <circle cx="12" cy="12" r="10"></circle>
                </svg>
                Transaksi
            </a>
            <button data-tab="products"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 6v6h4"></path>
                </svg>
                Daftar Produk
            </button>   
            <button data-tab="admin"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 7a4 4 0 01-8 0"></path>
                    <circle cx="12" cy="12" r="10"></circle>
                </svg>
                Manajemen Admin
            </button>
        </nav>
        <div class="px-4 py-6 border-t border-green-600 text-center text-sm select-none">
            &copy; 2024 FoodDash
        </div>
    </aside>
    <main class="flex-1 p-8 min-h-screen overflow-auto">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>

</html>
