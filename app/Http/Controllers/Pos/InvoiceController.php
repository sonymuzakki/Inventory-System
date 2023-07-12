<?php

namespace App\Http\Controllers\Pos;

use App\Models\Unit;
use App\Models\invoice;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class InvoiceController extends Controller
{
    public function invoiceAll(){
        $allData = invoice::orderBy('id','desc')->orderBy('id','desc')->get();
        return view('backend.invoices.invoice_all',compact('allData'));
    }

    public function invoiceAdd(Request $request){
        $category = Category::all();
        $costomer = Customer::all();
        $invoice_data = invoice::orderBy('id','desc')->first();
        if($invoice_data == null){
            $firstReq = '0';
            $invoice_no = $firstReq+1;
        }else{
            $invoice_data = invoice::orderBy('id','desc')->first();
            $invoice_no = $invoice_data+1;
        }
        $date = date('Y-m-d');
        return view('backend.invoices.invoice_add',compact('invoice_no','category','date','costomer'));
    }

    // public function invoiceStore (Request $request){
    //     if ($request->category_id == null ) {
    //         $notification = array(
    //             'message' => 'Sorry you do not select any item',
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->back()->($notification);
    //     } else {

    //         $count_category = count($re)
    //     }
    // }


}