<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cabadas jo</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vite CSS -->
<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-r from-green-600 to-green-400 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <!-- Logo -->
        <div class="flex justify-center items-center space-x-1">
            <img src="{{ asset('images/icon.png') }}" alt="Makanjo Logo" class="h-8 md:h-12 object-contain">
            <span class="text-3xl md:text-4xl font-extrabold text-green-600">Cabadas jo</span>
        </div>

        <!-- Heading -->
        <p class="text-center text-sm text-gray-500 mb-6">Gunakan akun admin Anda untuk bisa login</p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-1">Email</label>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 mb-1">Kata Sandi</label>
                <x-text-input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">
                Masuk
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-green-700 hover:underline text-sm">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

</body>

</html>
