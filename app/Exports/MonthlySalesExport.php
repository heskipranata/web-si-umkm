<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlySalesExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    protected $month;
    protected $year;
    protected $itemCount = 0; 

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        // Ambil data penjualan per item menu
        $items = DB::table('menus')
            ->leftJoin('transaction_items', function ($join) {
                $join->on('menus.name', '=', 'transaction_items.name');
                $join->whereMonth('transaction_items.created_at', $this->month);
                $join->whereYear('transaction_items.created_at', $this->year);
            })
            ->select(
                'menus.name',
                DB::raw('COALESCE(SUM(transaction_items.qty), 0) as total_qty'),
                'menus.price as unit_price',
                DB::raw('COALESCE(SUM(transaction_items.qty * transaction_items.price), 0) as total_price')
            )
            ->groupBy('menus.name', 'menus.price')
            ->orderByDesc('total_qty')
            ->get();


        $this->itemCount = $items->count();

        // Ringkasan
        $totalPendapatan = $items->sum('total_price');
        $totalTransaksi = Transaction::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->count();

        $data = collect();

        // Judul
        $data->push(['Laporan Penjualan Bulanan Restoran Cabadas jo']);
        $data->push(['']);

        // Ringkasan Penjualan
        $data->push(['Ringkasan Penjualan']);
        $data->push(['Bulan', Carbon::createFromDate($this->year, $this->month, 1)->format('F Y')]);
        $data->push(['Total Transaksi', $totalTransaksi]);
        $data->push(['Total Pendapatan (Rp)', number_format($totalPendapatan, 0, ',', '.')]);
        $data->push(['']);

        // Header tabel detail
        $data->push(['Detail Penjualan Produk']);
        $data->push(['Nama Menu', 'Jumlah Terjual', 'Harga Satuan (Rp)', 'Total (Rp)']);

        // Isi data penjualan, kirim angka asli tanpa number_format
        foreach ($items as $item) {
            $data->push([
                $item->name,
                $item->total_qty,
                (float) $item->unit_price,
                (float) $item->total_price,
            ]);
        }

        return $data;
    }


    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 20], 'alignment' => ['horizontal' => 'center']],
            3 => ['font' => ['bold' => true, 'size' => 16]],
            4 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
            6 => ['font' => ['bold' => true]],

            8 => ['font' => ['bold' => true, 'size' => 16]],
            9 => ['font' => ['bold' => true], 'size' => 12, 'alignment' => ['horizontal' => 'center']],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                foreach (range('A', 'D') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }

                $startRow = 9;
                $endRow = $startRow + $this->itemCount;

                $cellRange = "A{$startRow}:D{$endRow}";
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Format kolom Harga dan Total sebagai angka dengan ribuan
                $event->sheet->getDelegate()->getStyle("C{$startRow}:D{$endRow}")
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                $event->sheet->getStyle("B4:B6")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            },
        ];
    }
}
