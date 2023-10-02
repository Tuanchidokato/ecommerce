<?php

namespace App\Services;

use App\Http\Requests\CartRequest;

interface ProductService
{
    public function addProductIntoCart(CartRequest $cartRequest);
    public function getAllProductInCart();
    public function updateQuantityProduct($quantity,$product_item_id);
}
