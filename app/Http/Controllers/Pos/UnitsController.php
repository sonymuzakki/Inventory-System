<?php

namespace App\Http\Controllers\Pos;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitsController extends Controller
{
    public function UnitAll(){
        $unit = Unit::latest()->get();
        return view('backend.unit.unit_all',compact('unit'));
    }

    public function UnitAdd(){
        $unit = unit::all();
        return view('backend.unit.unit_add',compact('unit'));
    }

    public function UnitStore(Request $request){

        Unit::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Unit Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);

    } // End Method

    public function UnitEdit($id){
        $unit = Unit::findOrFail($id);

        return view('backend.unit.unit_edit',compact('unit'));
    }

    public function UnitUpdate(Request $request){
        $unit_id = $request->id;

        Unit::findOrFail($unit_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

         $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);

    } // End Method

    public function UnitDelete  ($id){

        Unit::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Unit Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}
