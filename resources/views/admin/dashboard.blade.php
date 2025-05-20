<x-admin-layout>
    <section class="tab-content" id="dashboard">
           <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">Dashboard Utama</h1>
        <a href="{{ route('admin.reports.index') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 shadow inline-flex items-center">
            <i data-feather="download" class="w-5 h-5 mr-3"></i>
            Download Laporan
        </a>
    </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 max-w-6xl">
            <!-- Total Pendapatan Bulanan -->
            <div class="bg-green-100 rounded-lg p-6 flex flex-col items-center justify-center shadow">
                <div class="text-green-800 text-4xl font-bold leading-none">
                    Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}
                </div>
                <p class="text-green-700 mt-2 font-semibold">Pendapatan Bulanan</p>
            </div>

            <!-- Total Transaksi Bulanan -->
            <div class="bg-green-100 rounded-lg p-6 flex flex-col items-center justify-center shadow">
                <div class="text-green-800 text-4xl font-bold leading-none">
                    {{ $totalTransaksiBulanIni }}
                </div>
                <p class="text-green-700 mt-2 font-semibold">Transaksi Bulanan</p>
            </div>

            <!-- Produk Terlaris -->
            <div class="bg-green-100 rounded-lg p-6 flex flex-col items-center justify-center shadow">
                <div class="text-green-800 text-3xl font-bold">
                    {{ $produkTerlaris->name }}
                </div>
                <p class="text-green-700 mt-2 font-semibold">Produk Terlaris</p>
            </div>
        </div>

        <!-- Grafik Pendapatan Mingguan -->
        <div class="bg-white rounded-lg shadow p-6 " style="height: 350px;">
            <canvas id="salesChart" style="width: 100%; height: 100%; display: block;"></canvas>
        </div>

        <!-- Tips -->
        <div class="max-w-6xl mx-auto mt-10">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-green-700 mb-4">Tips Penjualan Hari Ini</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Tambahkan promo paket hemat untuk menarik pembeli lebih banyak.</li>
                    <li>Perbarui stok produk secara rutin agar tidak kehabisan barang populer.</li>
                    <li>Gunakan foto produk yang menarik untuk meningkatkan penjualan.</li>
                    <li>Tingkatkan layanan pesan antar agar pelanggan puas dan repeat order.</li>
                    <li>Perhatikan feedback pelanggan untuk terus meningkatkan kualitas produk.</li>
                </ul>
            </div>
        </div>
    </section>

    @push('scripts')
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            
            // Ambil data dari controller Laravel
            const dataMingguan = @json($dataMingguan);
            console.log("Data mingguan:", dataMingguan);

            const weekLabels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
            const weekData = [
                dataMingguan.minggu_1 || 0,
                dataMingguan.minggu_2 || 0,
                dataMingguan.minggu_3 || 0,
                dataMingguan.minggu_4 || 0,
            ];

            const ctx = document.getElementById("salesChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: weekLabels,
                    datasets: [{
                        label: "Pendapatan per Minggu (Rp)",
                        data: weekData,
                        backgroundColor: "rgba(34,197,94,0.8)",
                        borderRadius: 6
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 500000,
                                callback: value => "Rp " + value.toLocaleString("id-ID")
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
