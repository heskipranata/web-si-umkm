<x-admin-layout>
    <h1 class="text-3xl font-bold mb-6">Tambah Produk</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Produk</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="w-full border rounded px-3 py-2" required />
        </div>

        <div class="mb-4">
            <label for="type" class="block font-semibold mb-1">Tipe Produk</label>
            <select id="type" name="type" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="makanan" {{ old('type') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ old('type') == 'minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-semibold mb-1">Harga (Rp)</label>
            <input type="number" id="price" name="price" min="1000" value="{{ old('price') }}"
                class="w-full border rounded px-3 py-2" required />
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Gambar Produk (opsional)</label>
            <input type="file" id="image" name="image" accept="image/*" />
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
            Simpan
        </button>
    </form>
</x-admin-layout>
