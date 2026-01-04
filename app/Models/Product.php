<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'price',
        'qty',
        'discount',
        'weight',
        'sku',
        'featured',
        'tag',
        'brand_id',
        'product_category_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'weight' => 'decimal:2',
        'featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}