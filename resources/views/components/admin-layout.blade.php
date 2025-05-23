<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cabadas jo | Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

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
    <aside class="w-72 bg-green-700 text-white flex flex-col">
        <!-- Sidebar content -->
        <div class="flex justify-center items-center mt-7">
            <img src="{{ asset('images/icon-w.png') }}" alt="Makanjo Logo" class="h-8 md:h-12 object-contain">
            <span class="text-3xl md:text-4xl font-extrabold text-white ml-2">Cabadas jo</span>
        </div>
        <nav class="flex-1 flex flex-col mt-6 space-y-1 px-4">
            <a data-tab="dashboard"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors active:bg-green-800"
                href="{{ route('dashboard') }}">
                <i data-feather="home" class="w-6 h-6 mr-3"></i>
                Dashboard Utama
            </a>
            <a data-tab="transactions"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors"
                href="{{ route('admin.transaction') }}">
                <i data-feather="clock" class="w-6 h-6 mr-3"></i>
                Transaksi
            </a>
            <a data-tab="products"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors"
                href=" {{ route('admin.product') }}">
                <i data-feather="shopping-bag" class="w-6 h-6 mr-3"></i>
                Daftar Produk
            </a>
            <a href="{{ route('admin.profile') }}" data-tab="admin"
                class="nav-btn flex items-center py-3 px-4 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors">
                <i data-feather="users" class="w-6 h-6 mr-3"></i>
                Manajemen Admin
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2 px-4">
                @csrf
                <button type="submit"
                    class="w-full flex items-center py-3 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600 transition-colors ">
                    <i data-feather="log-out" class="w-6 h-6 mr-3"></i>
                    Logout
                </button>
            </form>
        </nav>


        <div class="px-4 py-6 border-t border-green-600 text-center text-sm select-none">
            &copy; 2025 Cabadas jo
        </div>
    </aside>
    <main class="flex-1 p-8 min-h-screen overflow-auto">
        {{ $slot }}
    </main>

    @stack('scripts')
    <script>
        feather.replace();
    </script>
        <style>
        body {
            font-family: 'Figtree', sans-serif !important;
        }
    </style>
</body>

</html>
