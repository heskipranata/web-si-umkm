<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
}
