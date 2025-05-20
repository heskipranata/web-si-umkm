<x-admin-layout>
    <!-- Header Utama -->
    <div class="flex justify-between items-start mb-6">
        <!-- Judul Halaman -->
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Kelola Profil dan Akun Admin</h1>
            <p class=" text-gray-500 mt-1">
                Anda dapat memperbarui informasi profil, menghapus akun, atau menambahkan admin baru dari halaman ini.
            </p>
        </div>

        <!-- Info Admin Login di Kanan Atas -->
        <div class="flex items-center space-x-3">
            <div class="text-right">
                <h2 class="text-sm text-gray-500">Selamat datang admin,</h2>
                <h1 class="text-lg font-bold text-green-700">{{ auth()->user()->name }}</h1>
            </div>

        </div>
    </div>


    <div class="py-4">
        <div>
            <div class="bg-white shadow-md rounded-lg py-8 px-4 max-w-3xl">
                @if (session('status') === 'profile-updated')
                    <div class="mb-4 text-blue-600 font-semibold">
                        Profil berhasil diperbarui.
                    </div>
                @endif


                <!-- Form Edit Profil -->
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="pt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                            Simpan Perubahan Profil
                        </button>
                    </div>
                </form>

                <!-- Hapus Akun -->
                <hr class="my-10">
                <h2 class="text-lg font-semibold text-red-700 mb-2">Hapus Akun</h2>
                <form method="POST" action="{{ route('profile.destroy') }}"
                    onsubmit="return confirm('Yakin ingin menghapus akun Anda secara permanen?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        Hapus Akun Secara Permanen
                    </button>
                </form>

                <!-- Tambah Admin Baru -->
                <hr class="my-10">

                <h2 class="text-lg font-semibold text-green-700 mb-4">Tambah Admin Baru</h2>
                @if (session('status') === 'profile-created')
                    <div class="mb-4 text-green-600 font-semibold">
                        Profil berhasil ditambahkan.
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var element = document.getElementById('form-tambah-admin');
                            if (element) {
                                element.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }
                        });
                    </script>
                @endif
                <form method="POST" action="{{ route('profile.create') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Admin Baru</label>
                        <input type="text" name="name"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                            Tambahkan Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
