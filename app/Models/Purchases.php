<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;

    public $table = "purchases";
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(product::class, 'product_id','id');
    }
    public function supplier(){
        return $this->belongsTo(supplier::class, 'supplier_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id','id');
   }
}