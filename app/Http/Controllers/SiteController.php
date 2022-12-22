<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('site.index', compact('products'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = $category->products()->paginate(8);

        return view('site.category', compact('category', 'products'));
    }
    public function contact()
    {
    }
    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        // dd($product);
        $products = Product::all();
        return view('site.product', compact('product', 'products'));
    }
    public function serch(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->q . '%')->paginate(5);
        return view('site.serch_items', compact('products'));
    }
}
