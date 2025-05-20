<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlySalesExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports');
    }

    public function export(Request $request)
    {
        // Validasi input bulan dan tahun
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year'  => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $month = $request->month;
        $year = $request->year;

        $fileName = "laporan-penjualan-{$year}-{$month}.xlsx";

        return Excel::download(new MonthlySalesExport($month, $year), $fileName);
    }
}
