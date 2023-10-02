<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_rating extends Model
{
    use HasFactory;
    protected $table= 'product_rating';
    protected $fillable=[
        'user_id',
        'product_id',
        'star_rating'
    ];
}
