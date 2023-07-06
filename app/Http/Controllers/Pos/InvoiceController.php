<?php

namespace App\Http\Controllers\Pos;

use App\Models\Unit;
use App\Models\invoice;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function invoiceAll(){
        $allData = invoice::orderBy('id','desc')->orderBy('id','desc')->get();
        return view('backend.invoices.invoice_all',compact('allData'));
    }

    public function invoiceAdd(Request $request){
        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();
        return view('backend',compact('supplier','unit','category'));
    }
}