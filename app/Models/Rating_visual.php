<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating_visual extends Model
{
    use HasFactory;
    protected $table ='rating_visual';
    protected $fillable=[
        'star_rating_id',
        'image_url',
        'type',
        'url'
    ];
}
