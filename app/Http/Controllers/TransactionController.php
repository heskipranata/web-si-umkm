<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // TransactionController.php
    public function checkout()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|integer',
            'payment_method' => 'required|in:Cash,Transfer',
            'cart_items' => 'required|json',
        ]);

        // Simpan transaksi ke database
        $transaction = new Transaction();
        $transaction->customer_name = $validated['customer_name'];
        $transaction->table_number = $validated['table_number'];
        $transaction->payment_method = $validated['payment_method'];
        $transaction->optional_message = $request->optional_message;
        $transaction->cart_items = $validated['cart_items'];
        $transaction->save();

        $cartItems = json_decode($validated['cart_items'], true);
        foreach ($cartItems as $item) {
            $transaction->items()->create([
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ]);
        }
        // Redirect atau beri response sesuai kebutuhan
        return redirect()->route('transaction.success');
    }

    public function getByDate(Request $request)
    {
        $tanggal = $request->query('date');
        $start = Carbon::parse($tanggal)->startOfDay();
        $end = Carbon::parse($tanggal)->endOfDay();

        $transactions = Transaction::with('items')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $totalTransaksi = $transactions->count();

        $totalPendapatan = $transactions->reduce(function ($carry, $transaction) {
            return $carry + $transaction->items->sum(function ($item) {
                return $item->price * $item->qty;
            });
        }, 0);

        $transaksiData = $transactions->flatMap(function ($transaction) {
            return $transaction->items->map(function ($item) use ($transaction) {
                return [
                    'waktu' => $transaction->created_at->format('H:i'),
                    'produk' => $item->name,
                    'jumlah' => $item->qty,
                    'total' => $item->price * $item->qty,
                    'metode_bayar'=> $transaction->payment_method,
                    'nomor_meja'=> $transaction->table_number,
                ];
            });
        });

        return response()->json([
            'total_transaksi' => $totalTransaksi,
            'total_pendapatan' => $totalPendapatan,
            'transaksi' => $transaksiData,
        ]);
    }
}
