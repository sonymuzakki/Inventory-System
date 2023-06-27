<?php

namespace App\Http\Controllers\Pos;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productAll(){
        $product = Product::latest()->get();
        return view('backend.product.product_all',compact('product'));
    }

    public function productAdd(){
        $product = Product::all();
        $category = Category::all();
        $unit = Unit::all();
        $supplier = Supplier::all();

        return view('backend.product.product_add',compact('product','category','unit','supplier'));
    }

    public function productStore(Request $request){

        Product::insert([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'supplier_id' => $request->supplier_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Inserted Success',
            'alert-type' => 'success',
        );
        return redirect()->route('product.all')->with($notification);

    }

    public function productEdit($id){
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $product = Product::findOrfail($id);
        return view('backend.product.product_edit',compact('product','category','unit','supplier'));
    }

    public function productUpdate(Request $request){
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Product Updated Success',
            'alert-type' => 'success',
        );
        return redirect()->route('product.all')->with($notification);

    }

    public function productDelete($id){

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}