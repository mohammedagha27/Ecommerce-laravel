<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        $product = new Product();
        return view('admin.products.create', compact('categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|min:3',
            'name_ar' => 'required|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg',
            'description_en' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required'
        ]);
        $new_image_name = rand() . time() . str_replace(' ', '-', strtolower($request->file('image')->getClientOriginalName()));
        $request->file('image')->move(public_path('uploads/images/products'), $new_image_name);
        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ];
        $item = Product::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'image' => $new_image_name,
            'description' => json_encode($description, JSON_UNESCAPED_UNICODE),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'slug'=> Str::slug($request->name_en),
            'category_id' => $request->category_id,
            'user_id' => Auth::id()
        ]);
        if ($item) {
            return redirect()->back()->with('msg', 'Product Created successfully')->with('icon', 'info');
        } else {
            return redirect()->back()->with('msg', 'Product not Created')->with('icon', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::select(['id', 'name'])->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|min:3',
            'name_ar' => 'required|min:3',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'description_en' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required'
        ]);
        $product = Product::findOrFail($id);
        $old_image = $product->image;
        $data = $request->all();
        $new_image_name = $product->image;
        if ($request->hasFile('image')) {
            if (fileExists(public_path('uploads/images/products/') . $old_image)) {
                File::delete(public_path('uploads/images/products/') . $old_image);
            }
            $new_image_name = rand() . time() . str_replace(' ', '-', strtolower($request->file('image')->getClientOriginalName()));
            $request->file('image')->move(public_path('uploads/images/products'), $new_image_name);
            $data['image'] = $new_image_name;
        }
        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ];
        $item = $product->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'image' => $new_image_name,
            'description' => json_encode($description, JSON_UNESCAPED_UNICODE),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'slug'=> Str::slug($request->name_en),
        ]);
        if ($item) {
            return redirect()->back()->with('msg', 'Product Updated successfully')->with('icon', 'info');
        } else {
            return redirect()->back()->with('msg', 'Product not Updated')->with('icon', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            if (fileExists(public_path('uploads/images/products/') . $product->image)) {
                File::delete(public_path('uploads/images/products/') . $product->image);
            }
        }
        $product->delete();
        return redirect()->back()->with('msg', 'Product Deleted successfully')->with('icon', 'success');
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.products.trash', compact('products'));
    }

    public function restore($id)
    {
        Product::withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
    public function forcedelete($id)
    {
        Product::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back();
    }
}
