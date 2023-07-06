<?php

namespace App\Http\Controllers\Pos;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    public function purchaseAll(){
        $purchases = Purchases::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.purchases.purchases_all',compact('purchases'));
    }// End Method

    public function purchaseAdd(){

        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();
        return view('backend.purchases.purchases_add',compact('supplier','unit','category'));

    } // End Method

    public function PurchaseStore(Request $request){

        if ($request->category_id == null) {

           $notification = array(
            'message' => 'Sorry you do not select any item',
            'alert-type' => 'error'
        );
        return redirect()->back( )->with($notification);
        } else {

            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) {
                $purchase = new Purchases();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];

                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            } // end foreach
        } // end else

        $notification = array(
            'message' => 'Data Save Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification);
        }// End Method

        public function PurchaseDelete($id){

            Purchases::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Purchases Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }

        public function PurchasePending(){

            $allData = Purchases::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
            return view('backend.purchases.purchases_pending',compact('allData'));
        }// End Method

        public function PurchaseApprove($id){

            $purchase = Purchases::findOrFail($id);
            $product = Product::where('id',$purchase->product_id)->first();
            $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
            $product->quantity = $purchase_qty;

            if($product->save()){

                Purchases::findOrFail($id)->update([
                    'status' => '1',
                ]);

                 $notification = array(
            'message' => 'Status Approved Successfully',
            'alert-type' => 'success'
              );
        return redirect()->route('purchase.all')->with($notification);

            }

        }// End Method

}