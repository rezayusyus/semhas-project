<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman pesanan
     */
    public function index()
    {
        // Ambil data pesanan dari sesi
        $orders = session()->get('orders', []); 

        // Jika menggunakan database, dapat diubah seperti:

        return view('pesanan', compact('orders'));
    }

    /**
     * Menambahkan pesanan baru (saat checkout)
     */
    public function store(Request $request)
    {
        // Ambil data keranjang dari sesi
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong, tidak ada yang bisa dipesan.');
        }

        // Ambil data pesanan yang sudah ada dari sesi
        $orders = session()->get('orders', []);

        // Proses setiap item di keranjang untuk dimasukkan ke pesanan
        foreach ($cart as $item) {
            $orders[] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
                'booking_date' => $item['booking_date'] ?? null,
                'image' => $item['image'],
                'description' => $item['description'] ?? '',
            ];
        }

        // Simpan pesanan ke sesi (atau database jika diperlukan)
        session()->put('orders', $orders);

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan!');
    }
}
