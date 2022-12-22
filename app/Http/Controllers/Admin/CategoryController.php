<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        $category = new Category();
        return view('admin.categories.create', compact('categories', 'category'));
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
            'name_en' => 'required|min:3|unique:categories,slug',
            'name_ar' => 'required|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg',
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        $new_image_name = rand() . time() . str_replace(' ', '-', strtolower($request->file('image')->getClientOriginalName()));
        $request->file('image')->move(public_path('uploads/images/categories'), $new_image_name);
        $data = $request->all();
        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $item = Category::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'image' => $new_image_name,
            'slug' => Str::slug($request->name_en),
            'parent_id' => $request->parent_id,
        ]);
        if ($item) {
            return redirect()->back()->with('msg', 'Category Created successfully')->with('icon', 'info');
        } else {
            return redirect()->back()->with('msg', 'Category not Created')->with('icon', 'error');
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
        $category = Category::find($id);
        $categories = Category::select(['id', 'name'])->get();
        return view('admin.categories.edit', compact('category', 'categories'));
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
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->all();
        $new_image_name = $category->image;
        if ($request->hasFile('image')) {
            if (fileExists(public_path('uploads/images/categories/') . $old_image)) {
                File::delete(public_path('uploads/images/categories/') . $old_image);
            }
            $new_image_name = rand() . time() . str_replace(' ', '-', strtolower($request->file('image')->getClientOriginalName()));
            $request->file('image')->move(public_path('uploads/images/categories'), $new_image_name);
            $data['image'] = $new_image_name;
        }
        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $item = $category->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'image' => $new_image_name,
            'parent_id' => $request->parent_id
        ]);
        if ($item) {
            return redirect()->back()->with('msg', 'Category Updated successfully')->with('icon', 'info');
        } else {
            return redirect()->back()->with('msg', 'Category not Updated')->with('icon', 'error');
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
        $category = Category::findOrFail($id);
        Category::where('parent_id', $category->id)->update(['parent_id' => null]);
        if ($category->image) {
            if (fileExists(public_path('uploads/images/categories/') . $category->image)) {
                File::delete(public_path('uploads/images/categories/') . $category->image);
            }
        }
        $category->delete();
        return 'Category Deleted Successfully';
    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
    public function forcedelete($id)
    {
        Category::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back();
    }
}
