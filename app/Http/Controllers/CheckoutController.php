<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Mengambil data keranjang dari session untuk ditampilkan di halaman checkout
        $cart = session()->get('cart', []);
        
        // Hitung total jumlah pembayaran
        $totalAmount = array_sum(array_column($cart, 'price'));

        return view('checkout.index', compact('cart', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        // Validasi inputan dari form checkout
        $request->validate([
            'table_number' => 'required|string',
            'phone_number' => 'required|string',
            'payment_method' => 'required|in:cash,bri',
            'optional_message' => 'nullable|string',
        ]);

        // Mengambil data keranjang dari session
        $cart = session()->get('cart', []);
        
        // Hitung total jumlah pembayaran
        $totalAmount = array_sum(array_column($cart, 'price'));

        // Simpan transaksi ke database
        $transaction = Transaction::create([
            'table_number' => $request->table_number,
            'phone_number' => $request->phone_number,
            'optional_message' => $request->optional_message,
            'payment_method' => $request->payment_method,
            'total_amount' => $totalAmount,
            'status' => 'pending', // Status defaultnya pending, bisa diubah setelah pembayaran diterima
        ]);

        // Menghapus data keranjang setelah transaksi disimpan
        session()->forget('cart');

        // Mengarahkan ke halaman konfirmasi pembayaran atau tampilan lain
        return redirect()->route('cart.index')->with('success', 'Pesanan berhasil diproses. Terima kasih!');
    }
}
