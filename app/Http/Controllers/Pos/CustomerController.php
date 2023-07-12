<?php

namespace App\Http\Controllers\Pos;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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

        $image =  $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'customer_image' => $save_url,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer Inserted Success',
            'alert-type' => 'success',
        );
        return redirect()->route('customer.all')->with($notification);
    }

    public function CustomerUpdate(Request $request){

        $customer_id = $request->id;
        if ($request->file('customer_image')) {

        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'customer_image' => $save_url ,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Customer Updated with Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

        } else{

        Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Customer Updated without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

        } // end else

    } // End Method

    public function CustomerDelete($id){

        $customers = Customer::findOrfail($id);
        $img = $customers->customer_image;
        unlink($img);

        Customer::findOrfail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
} // End Method
