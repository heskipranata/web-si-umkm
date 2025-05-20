<x-admin-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-14">
        <h1 class="text-4xl font-bold text-green-700 mb-2">Laporan Penjualan Bulanan</h1>
        <p class="text-gray-600 mb-6">Silakan pilih bulan dan tahun untuk mengunduh laporan penjualan dalam format Excel. Laporan ini berisi data transaksi dan total pendapatan selama periode tersebut.</p>

        <form action="{{ route('admin.reports.export') }}" method="GET" class="space-y-6">
            @csrf
            <div>
                <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bulan</label>
                <select id="month" name="month" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500" required>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ old('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tahun</label>
                <select id="year" name="year" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500" required>
                    @for ($y = date('Y'); $y >= 2000; $y--)
                        <option value="{{ $y }}" {{ old('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-semibold shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" 
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 4v16h16V4H4zm4 8h8m-4-4v8" />
                    </svg>
                    Unduh Excel
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
