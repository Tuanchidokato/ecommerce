<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\ServiceImpl\ProductServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
{
    $this->productService=$productService;
}
    public function insertCate(Request $request){
        $category=(new Category())->insertCategory($request);

        return response()->json([
            "data"=>$category
        ]);
    }
    public function createProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $data=[
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image_url' => $request->input('image_url'),
            'category_id' => $request->input('category_id'),
        ];
        return (new Product())->insertProduct($data);
    }


    /*
     * Rating for product
     *
     */
    public function ratingProduct(Request $request){
        // Kiểm tra xem request có chứa file hình ảnh không
        if ($request->hasFile('image')) {
            // Lấy file hình ảnh từ request
            $image = $request->file('image');

            // Tạo tên duy nhất cho hình ảnh
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Lưu trữ hình ảnh vào thư mục public/images (bạn có thể tùy chỉnh đường dẫn)
            $image->move(public_path('images'), $imageName);

            // Trả về thông báo thành công hoặc thực hiện các xử lý khác theo yêu cầu của bạn
            return response()->json(['message' => 'Hình ảnh đã được tải lên thành công']);
        } else {
            // Trả về thông báo lỗi nếu không tìm thấy file hình ảnh trong request
            return response()->json(['message' => 'Không tìm thấy hình ảnh trong request'], 400);
        }
    }

    public function addProductIntoCart(CartRequest $cartRequest){
        return $this->productService->addProductIntoCart($cartRequest);
    }

    public function getAllProductInCart(){
        return $this->productService->getAllProductInCart();
    }
    public function updateQuantityProduct($product_item_id,Request $request){
        return $this->productService->updateQuantityProduct($request->quantity,$product_item_id);
    }

}
