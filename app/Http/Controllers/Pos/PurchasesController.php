<?php

namespace App\Http\Controllers\Pos;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{
    public function purchasesAll(){
        $purchases = Purchases::all();

        return view('backend.purchases.purchases_all',compact('purchases'));
    }

    public function purchasesAdd(){

        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();
        return view('backend.purchases.purchases_add',compact('supplier','unit','category'));

    } // End Method
}