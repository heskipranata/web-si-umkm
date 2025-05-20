<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $totalPendapatanBulanIni = TransactionItem::whereHas('transaction', function ($query) use ($now) {
            $query->whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year);
        })->sum(DB::raw('price * qty'));

        $totalTransaksiBulanIni = Transaction::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $produkTerlaris = TransactionItem::select('name', DB::raw('SUM(qty) as total_qty'))
            ->whereHas('transaction', function ($query) use ($now) {
                $query->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year);
            })
            ->groupBy('name')
            ->orderByDesc('total_qty')
            ->first();

        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $dataMingguan = [];

        for ($i = 0; $i < 4; $i++) {
            // Mulai minggu ke-i (Senin sebagai awal minggu)
            $startOfWeek = $startOfMonth->copy()->addWeeks($i)->startOfWeek(Carbon::MONDAY);

            // Akhir minggu, batasi sampai akhir bulan
            $endOfWeek = $startOfWeek->copy()->endOfWeek(Carbon::SUNDAY);
            if ($endOfWeek->greaterThan($endOfMonth)) {
                $endOfWeek = $endOfMonth;
            }

            $totalPendapatanMinggu = TransactionItem::whereHas('transaction', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            })->sum(DB::raw('price * qty'));

            $dataMingguan["minggu_" . ($i + 1)] = $totalPendapatanMinggu;
        }
        return view('admin.dashboard', compact(
            'totalPendapatanBulanIni',
            'totalTransaksiBulanIni',
            'produkTerlaris',
            'dataMingguan'
        ));
    }

    public function product()
    {
        $menus = Menu::all();
        return view('admin.products', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu-create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'type'  => 'required|in:makanan,minuman',
            'price' => 'required|integer|min:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu-images', 'public');
        }

        Menu::create($validated);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu-edit', compact('menu'));
    }

    // Update data produk
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'type'  => 'required|in:makanan,minuman',
            'price' => 'required|integer|min:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $validated['image'] = 'images/menu/' . $imageName;
        }

        $menu->update($validated);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus');
    }
}
