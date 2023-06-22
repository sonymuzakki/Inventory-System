<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function CustomerAll(){
        $customer = Customer::latest()->get();
        return view('backend.Customer.customer_all',compact('customer'));
    }

    public function CustomerAdd(){
        $customer = Customer::all();
        return view('backend.Customer.customer_add',compact('customer'));
    }

    public function CustomerEdit($id){
        $customer = Customer::findOrFail($id);
        return view('backend.Customer.customer_edit', compact('customer'));
    }
}