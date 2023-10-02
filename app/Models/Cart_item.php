<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    use HasFactory;
    protected $table='cart_items';
    public function product_item(){
        return $this->belongsTo(Product_item::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected $fillable=[
        'quantity',
        'product_item_id',
        'user_id'
    ];
}
