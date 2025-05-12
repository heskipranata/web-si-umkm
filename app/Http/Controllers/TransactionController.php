<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

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

        // Redirect atau beri response sesuai kebutuhan
        return redirect()->route('transaction.success'); // Ganti dengan rute yang sesuai
    }
}
