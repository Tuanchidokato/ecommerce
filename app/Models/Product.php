<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;
    protected $table='products';

    public function categories(){
        return $this->belongsTo(Category::class);
    }
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'category_id',
    ];

    public function insertProduct($data){

        $category=Category::where('id',$data['category_id'])->first();
        if(!$category){
            return response()->json([
                "message"=>"can't find category"
            ]);
        }
        $product = new Product();
        $product->name=$data['name'];
        $product->description=$data['description'];
        $product->price=$data['price'];
        $product->image_url=$data['image_url'];

        $category->products()->save($product);
        return response()->json([
            "messase"=>"save product successfully",
            "data"=>$product
        ]);
    }
}
