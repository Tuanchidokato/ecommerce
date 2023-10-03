<?php

namespace App\Services\ServiceImpl;

use App\Http\Requests\CartRequest;
use App\Models\Cart_item;
use App\Models\Product_item;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class CartServiceImpl implements CartService
{
    /**
     * Thêm sản phẩm vào giỏ hàng dựa trên yêu cầu từ người dùng.
     *
     * @param  \Illuminate\Http\Request $cartRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProductIntoCart(CartRequest $cartRequest)
    {


        // Lấy thông tin lựa chọn sản phẩm từ yêu cầu của người dùng
        $options = $cartRequest->options;
        // Tạo truy vấn để kiểm tra sự tồn tại của sản phẩm
        $query = DB::table('product_item_detail as pd1')
                ->select('pd1.product_item_id');
                 for ($i = 1; $i < count($options); $i++) {
                     $query->join("product_item_detail as pd".($i+1), "pd{$i}.product_item_id", '=', "pd".($i+1).".product_item_id");
                 }
                 for ($i = 1; $i <= count($options); $i++) {
                    $query->where("pd{$i}.product_option_detail_id", '=', $options[$i -1]);
                 }
                 $items = $query->first();

         if($items === null){
             return response()->json([
                 "message"=>"cant find the product item"
             ],200);
         }
        $productItem = Product_item::find($items->product_item_id);
        if (!$productItem) {
            return response()->json([
                "message" => "We cant find the product."
            ], 404);
        }

        // Kiểm tra số lượng sản phẩm và thêm vào giỏ hàng nếu hợp lệ
        if($cartRequest->quantity>$productItem->quantity){
            return response()->json([
                "message" => "Too much quantity in stock"
            ], 404);
        }
        $user=auth()->user();
        $cart_item=[
            "quantity"=>$cartRequest->quantity,
            "user_id"=>$user->id,
            "product_item_id"=>$items->product_item_id
        ];


         // kiểm tra xem items đã có trong cart hay chưa
        $cart_item_in_cart=Cart_item::where('product_item_id',$items->product_item_id)->first();
         if($cart_item_in_cart){
             $product_item=$cart_item_in_cart->product_item;
             if(($cart_item_in_cart->quantity+$cartRequest->quantity) >$product_item->quantity){
                 return response()->json([
                     "message" => "Too much quantity in stock"
                 ], 404);
             }
             $cart_item_in_cart->quantity=$cart_item_in_cart->quantity+$cartRequest->quantity;
             $cart_item_in_cart->save();
             // Trả về phản hồi JSON với thông tin về sản phẩm đã thêm vào giỏ hàng hoặc thông báo lỗi
             return response()->json([
                 "message"=>"Insert product into cart successfully",
                 "data"=>$cart_item_in_cart
             ],200);
         }else{
             Cart_item::create($cart_item);
             // Trả về phản hồi JSON với thông tin về sản phẩm đã thêm vào giỏ hàng hoặc thông báo lỗi
             return response()->json([
                 "message"=>"Insert product into cart successfully",
                 "message"=>$cart_item
             ],200);
         }




    }

    /**
     * Lấy danh sách sản phẩm trong giỏ hàng với thông tin cơ bản của mỗi sản phẩm, kèm theo tên và hình ảnh sản phẩm.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProductInCart($currentPage,$perPage)
    {
        $cart = Cart_item::with(['product_item.product' => function ($query) {
            $query->select('id', 'name', 'image_url'); // Chọn các trường cần thiết từ product
        }])
            ->get(['id', 'quantity', 'product_item_id', 'user_id']);
//            ->paginate(1, ['*'], 'page', 1);;

        $totalItems = $cart->count();
        $cartItems = $cart->forPage($currentPage, $perPage);

        $cartItems = new \Illuminate\Pagination\LengthAwarePaginator(
            $cartItems,
            $totalItems,
            $perPage,
            $currentPage
        );
        // Chọn các trường cần thiết từ cart_item
        return response()->json([
            "data" => $cartItems
        ], 200);

    }

    public function updateQuantityProduct($quantity, $product_item_id)
    {
        if($quantity<=0){
            return response()->json([
                "message" => "Quantity must be greater than 0"
            ], 404);
        }
        $cart_item= Cart_item::where('product_item_id',$product_item_id)->first();
        $product_item=$cart_item->product_item;
        if($quantity>$product_item->quantity){
            return response()->json([
                "message" => "Too much quantity in stock"
            ], 404);
        }
        $cart_item->quantity=$quantity;
        $cart_item->save();
        return response()->json([
            "message"=>"update quantity successfully",
            "data"=>$cart_item
        ],200);
    }

    public function deleteProductInCart($product_item_id)
    {
        $productItem=Cart_item::where('product_item_id',$product_item_id)->first();
        if(!$productItem){
            return response()->json([
                "message"=>"We cant find the product item"
            ],200);
        }
        $productItem->delete();
        return response()->json([
            "message"=>"delete product succcessfully"
        ],200);
    }
}
