<x-admin-layout>
  <section class="tab-content" id="products">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-green-700">Daftar Produk</h1>
      <a id="btnOpenAdd" class="bg-green-600 hover:bg-green-700 px-5 py-2 rounded text-white font-semibold transition" href="{{ route('menus.create') }}">+ Tambah Produk</a>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-200 rounded overflow-hidden shadow-sm">
        <thead class="bg-green-100 text-green-800 font-semibold">
          <tr>
            <th class="py-3 px-5 border-b border-green-300 text-left">Gambar</th>
            <th class="py-3 px-5 border-b border-green-300 text-left">Nama Produk</th>
            <th class="py-3 px-5 border-b border-green-300 text-left">Jenis</th>
            <th class="py-3 px-5 border-b border-green-300 text-left">Harga (Rp)</th>
            <th class="py-3 px-5 border-b border-green-300 w-40 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-green-200">
          @foreach ($menus as $menu)
            <tr>
              <td class="py-3 px-5">
                @if ($menu->image)
                   <img src="{{ Str::startsWith($menu->image, ['http://', 'https://']) ? $menu->image : asset($menu->image) }}" alt="{{ $menu->name }}" class="h-16 w-16 object-cover rounded" />
                @else
                  <span class="text-gray-500 italic">Tidak ada gambar</span>
                @endif
              </td>
              <td class="py-3 px-5">{{ $menu->name }}</td>
              <td class="py-3 px-5 capitalize">{{ $menu->type }}</td>
              <td class="py-3 px-5">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
              <td class="py-3 px-5 space-x-2">
                <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

  <!-- Modal Tambah Produk -->
  <div id="modal" class="modal hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
      <h2 id="modalTitle" class="text-xl font-bold mb-4 text-green-700">Tambah Produk</h2>
      <form id="productForm" action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
          <label for="productName" class="block mb-1 font-semibold">Nama Produk</label>
          <input type="text" id="productName" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required />
        </div>

        <div>
          <label for="productType" class="block mb-1 font-semibold">Jenis Produk</label>
          <select id="productType" name="type" class="w-full border border-gray-300 rounded px-3 py-2" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
          </select>
        </div>

        <div>
          <label for="productPrice" class="block mb-1 font-semibold">Harga (Rp)</label>
          <input type="number" id="productPrice" name="price" min="1000" class="w-full border border-gray-300 rounded px-3 py-2" required />
        </div>

        <div>
          <label for="productImage" class="block mb-1 font-semibold">Gambar Produk</label>
          <input type="file" id="productImage" name="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" id="btnCancel" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
          <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white font-semibold">Simpan</button>
        </div>
      </form>

      <button id="modalClose" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
  </div>

  @push('scripts')
  <script>
    const modal = document.getElementById('modal');
    const btnOpenAdd = document.getElementById('btnOpenAdd');
    const btnCancel = document.getElementById('btnCancel');
    const modalClose = document.getElementById('modalClose');

    const showModal = () => modal.classList.remove('hidden');
    const hideModal = () => modal.classList.add('hidden');

    btnOpenAdd.addEventListener('click', () => {
      document.getElementById('modalTitle').textContent = 'Tambah Produk';
      document.getElementById('productForm').reset();
      showModal();
    });

    btnCancel.addEventListener('click', hideModal);
    modalClose.addEventListener('click', hideModal);
  </script>
  @endpush
</x-admin-layout>
