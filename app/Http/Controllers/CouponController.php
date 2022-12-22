<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use PhpParser\Node\Expr\Cast\Array_;
use function PHPUnit\Framework\fileExists;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->paginate(5);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = $this->getEnumValues('coupons', 'type');
        $categories = Category::select(['id', 'name'])->get();
        $coupon = new Coupon();
        return view('admin.coupons.create', compact('categories', 'coupon', 'type'));
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
            'name' => 'required|min:3',
            'coupon' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'expire_date' => 'required|date'
        ]);
        $data=$request->all();
        $item = Coupon::create($data);
        if ($item) {
            return redirect()->back()->with('msg', 'Coupon Created successfully')->with('icon', 'info');
        } else {
            return redirect()->back()->with('msg', 'Coupon not Created')->with('icon', 'error');
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
        $type = $this->getEnumValues('coupons', 'type');
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit', compact('coupon', 'type'));
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
            'name' => 'required|min:3',
            'coupon' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'expire_date' => 'nullable|date'
        ]);
        $coupon = Coupon::findOrFail($id);
        $data = $request->all();
        $item = $coupon->update($data);
        if ($item) {
            return redirect()->back()->with('msg', 'Coupon Updated successfully')->with('icon', 'info');
        } else {
            return redirect()->back()->with('msg', 'Coupon not Updated')->with('icon', 'error');
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
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('msg', 'Coupon Deleted successfully')->with('icon', 'success');
    }
    public function trash()
    {
        $coupons = Coupon::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.coupons.trash', compact('coupons'));
    }

    public function restore($id)
    {
        Coupon::withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
    public function forcedelete($id)
    {
        Coupon::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back();
    }
    public static function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = Arr::add($enum, $v, $v);
        }
        return $enum;
    }
}
