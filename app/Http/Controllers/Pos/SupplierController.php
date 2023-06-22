<?php

namespace App\Http\Controllers\Pos;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
   public function SupplierAll(){

    $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all',compact('suppliers'));
    } // End Method

   public function SupplierAdd(){

    $suppliers = Supplier::all();
        return view('backend.supplier.supplier_add',compact('suppliers'));
    } // End Method

    public function SupplierStore(Request $request){
        // dd($request);
        supplier::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'address' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier Inserted Success',
            'alert-type' => 'success',
        );
        return redirect()->route('supplier.all')->with($notification);
    }

    public function SupplierEdit($id){
        $supplier = Supplier::findOrFail($id);

        return view('backend.supplier.supplier_edit',compact('supplier'));
    }

    public function SupplierUpdate(Request $request){
        $supplier_id = $request->id;

        Supplier::findOrFail($supplier_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);

    } // End Method

    public function SupplierDelete($id){

        Supplier::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Supplier Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}