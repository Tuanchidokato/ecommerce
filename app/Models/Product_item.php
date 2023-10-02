<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Product_item extends Model
{
    use HasFactory;
    protected $table='product_items';

    public function cart_item(){
        return $this->hasMany(Cart_item::class,'product_item_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    protected $fillable=[
        'price',
        'quantity',
        'status',
        'title',
        'product_id'
    ];
}
