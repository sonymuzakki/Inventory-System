<?php

namespace App\Http\Controllers\Pos;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function CustomerStore(Request $request){
        // dd($request);
        Customer::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'address' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer Inserted Success',
            'alert-type' => 'success',
        );
        return redirect()->route('customer.all')->with($notification);
    }

}