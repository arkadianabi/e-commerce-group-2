<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        $products = Product::with(['productCategory', 'productImages'])->latest()->get();
        return view('front.home', compact('categories', 'products'));
    }

    public function show($slug)
    {
        // mencari produk berdasarkan slug
        // jika tidak ditemukan, menampilkan halaman 404
        $product = Product::with(['productCategory', 'productImages', 'store'])
            ->where('slug', $slug)
            ->firstOrFail();

        // menampilkan halaman detail produk
        return view('front.details', compact('product'));
    }
}