<?php

namespace App\Services;

use App\Http\Requests\CartRequest;

interface CartService
{
    public function addProductIntoCart(CartRequest $cartRequest);
    public function getAllProductInCart($currentPage,$perPage);
    public function updateQuantityProduct($quantity,$product_item_id);
    public function deleteProductInCart($product_item_id);
}
