<?php

namespace App\Http\Controllers\Pos;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function CategoryAll(){
        $category = Category::latest()->get();
        return view('backend.category.category_all',compact('category'));
    }

    public function CategoryAdd(){
        $category = Category::all();
        return view('backend.category.category_add',compact('category'));
    }

    public function CategoryStore(Request $request){

        Category::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);

    } // End Method

    public function CategoryEdit($id){
        $category = Category::findOrFail($id);

        return view('backend.category.category_edit',compact('category'));
    }

    public function CategoryUpdate(Request $request){
        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

         $notification = array(
            'message' => 'category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);

    } // End Method

    public function CategoryDelete  ($id){

        Category::findOrFail($id)->delete();

         $notification = array(
              'message' => 'category Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}