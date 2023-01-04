<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect ('/login');

    }

    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        // return view('admin.index',compact('adminData'));
        return redirect ('/admin/profile');


    }
}