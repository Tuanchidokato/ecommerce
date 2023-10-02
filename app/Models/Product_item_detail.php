<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_item_detail extends Model
{
    use HasFactory;
    protected $table ='product_item_detail';
    public function product_option_detail(){
        return $this->belongsTo(Product_option_detail::class);
    }
    protected $fillable=[
        'product_item_id',
        'product_option_detail_id'
    ];
}
