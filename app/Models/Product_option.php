<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_option extends Model
{
    use HasFactory;
    protected $table='product_options';
    public function product(){
        return $this->belongsTo(Product::class);
    }
    protected $fillable=[
        'option',
        'product_id',
    ];
}
