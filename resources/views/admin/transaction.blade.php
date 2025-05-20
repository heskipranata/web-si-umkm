<x-admin-layout>
    <section class="tab-content" id="transactions">
        <h1 class="text-3xl font-bold text-green-700 mb-6">Transaksi Harian</h1>

        <!-- Filter Tanggal -->
        <div class="mb-4 flex items-center gap-4">
            <label for="tanggalTransaksi" class="font-semibold text-lg text-green-700">Pilih Tanggal:</label>
            <input type="date" id="tanggalTransaksi" class="border border-gray-300 rounded px-3 py-2">
            <button onclick="loadTransactionsByDate()"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Tampilkan
            </button>
        </div>

        <!-- Ringkasan -->
        <div class="space-y-4 max-w-4xl">
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center">
                <span class="font-semibold text-lg">Total Transaksi</span>
                <span id="totalTransactions" class="text-green-600 font-bold text-xl">0</span>
            </div>
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center">
                <span class="font-semibold text-lg">Total Pendapatan</span>
                <span id="totalRevenue" class="text-green-600 font-bold text-xl">Rp 0</span>
            </div>

            <!-- Tabel Transaksi -->
            <div class="bg-white rounded-lg shadow p-5 overflow-x-auto">
                <table class="min-w-full text-left border border-gray-200 rounded">
                    <thead class="bg-green-100 text-green-700 font-semibold">
                        <tr>
                            <th class="py-3 px-5 border-b border-green-300">Waktu</th>
                            <th class="py-3 px-5 border-b border-green-300">Nomor Meja</th>
                            <th class="py-3 px-5 border-b border-green-300">Produk</th>
                            <th class="py-3 px-5 border-b border-green-300">Jumlah</th>
                            <th class="py-3 px-5 border-b border-green-300">Total (Rp)</th>
                            <th class="py-3 px-5 border-b border-green-300">Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody" class="divide-y divide-green-200">
                        <!-- Data dari JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            async function loadTransactionsByDate() {
                const date = document.getElementById('tanggalTransaksi').value;
                if (!date) return alert("Silakan pilih tanggal terlebih dahulu.");

                try {
                    const response = await fetch(`/dashboard/transaction/by-date?date=${date}`);

                    if (!response.ok) throw new Error("Gagal mengambil data dari server.");

                    const result = await response.json();

                    // Set total
                    document.getElementById('totalTransactions').textContent = result.total_transaksi;
                    document.getElementById('totalRevenue').textContent = "Rp " + result.total_pendapatan.toLocaleString(
                        'id-ID');

                    // Isi tabel
                    const tbody = document.getElementById('transactionTableBody');
                    tbody.innerHTML = ''; // Kosongkan dulu

                    if (result.transaksi.length === 0) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td colspan="4" class="py-3 px-5 text-center text-gray-500">Belum ada transaksi untuk tanggal ini.</td>
                `;
                        tbody.appendChild(row);
                        return;
                    }

                    let lastWaktu = null;
                    let isAlternate = false;

                    result.transaksi.forEach(item => {
                        // Ganti warna jika waktu berubah
                        if (item.waktu !== lastWaktu) {
                            isAlternate = !isAlternate;
                            lastWaktu = item.waktu;
                        }

                        const row = document.createElement('tr');
                        row.className = isAlternate ? 'bg-gray-50' : 'bg-white';

                        row.innerHTML = `
                    <td class="py-2 px-5 border-b border-green-100">${item.waktu}</td>
                    <td class="py-2 px-5 border-b border-green-100">${item.nomor_meja}</td>
                    <td class="py-2 px-5 border-b border-green-100">${item.produk}</td>
                    <td class="py-2 px-5 border-b border-green-100">${item.jumlah}</td>
                    <td class="py-2 px-5 border-b border-green-100">Rp ${item.total.toLocaleString('id-ID')}</td>
                    <td class="py-2 px-5 border-b border-green-100">${item.metode_bayar}</td>
                `;
                        tbody.appendChild(row);
                    });

                } catch (error) {
                    alert("Gagal memuat data transaksi. Cek console.");
                    console.error(error);
                }
            }

            // Jalankan otomatis saat halaman dibuka
            document.addEventListener("DOMContentLoaded", () => {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('tanggalTransaksi').value = today;
                loadTransactionsByDate();
            });
        </script>
    @endpush
</x-admin-layout>
