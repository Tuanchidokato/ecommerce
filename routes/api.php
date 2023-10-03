<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login',[UserController::class,'login']);
Route::post('signUp',[UserController::class,'signUp']);

//Route::group(['middleware' => ['cors', 'json.response','auth:api']], function () {
//    // ...
//});
Route::middleware(['cors', 'json.response','auth:api'])->group(function(){
    Route::get('userDetail',[UserController::class,'userDetail']);
    Route::post('insertCate',[\App\Http\Controllers\CartController::class,'insertCate']);
    Route::post('createProduct',[\App\Http\Controllers\CartController::class,'createProduct']);
    Route::post('addProductIntoCart',[\App\Http\Controllers\CartController::class,'addProductIntoCart']);
    Route::get('getAllProductInCart/{perPage}/{currentPage}', [\App\Http\Controllers\CartController::class, 'getAllProductInCarts'])
        ->where('perpage', '[0-9]+') // Đảm bảo perpage là số nguyên dương
        ->where('currentpage', '[0-9]+'); // Đảm bảo currentpage là số nguyên dương

    Route::put('updateQuantityProduct/{product_item_id}',[\App\Http\Controllers\CartController::class,'updateQuantityProduct']);
    Route::delete('deleteProductInCart/{product_item_id}',[\App\Http\Controllers\CartController::class,'deleteProductInCart']);


});
Route::post('comment',[\App\Http\Controllers\CartController::class,'ratingProduct']);

