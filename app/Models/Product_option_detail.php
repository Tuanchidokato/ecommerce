<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_option_detail extends Model
{
    use HasFactory;
    protected $table='product_option_detail';
    protected $fillable=[
        'value',
        'product_id',
        'product_option_id'
    ];
}
