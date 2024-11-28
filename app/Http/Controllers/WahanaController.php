<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wahana;

class WahanaController extends Controller
{
    public function index()
    {
        // Ambil semua wahana dari database
        $wahanas = Wahana::all();
        return view('admin.wahana.index', compact('wahanas')); // Arahkan ke view wahana.index
    }
    public function create()
    {
        return view('admin.wahana.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi gambar
        ]);

        // Proses upload gambar
        $imagePath = $request->file('image')->store('wahana_images', 'public'); // Menyimpan di folder public/wahana_images

        // Simpan data wahana ke database
        Wahana::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // Simpan path gambar di database
        ]);

        return redirect()->route('admin.dashboard'); // Redirect setelah sukses
    }
}
