<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get()->groupBy('name');

        return view('fasilitas', [
            'categories' => $categories,
        ]);
    }
}
