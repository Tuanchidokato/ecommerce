<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
    protected $fillable=[
        'title',
        'slug',
        'description',
        'status',
        'parent_id',
    ];
    public function insertCategory(Request $request){

        $category=Category::create($request->all());
        return $category;
    }
}
