<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
     use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    //relation with order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    //relation with product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
