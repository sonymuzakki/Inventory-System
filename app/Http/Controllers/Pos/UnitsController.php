<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function UnitAll(){
        $unit = Unit::latest()->get();
        return view('backend.unit.unit_all',compact('unit'));
    }

    public function UnitAdd(){
    
    }
}