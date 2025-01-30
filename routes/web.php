<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RatingController;



Route::prefix('admin')->name('admin.')->middleware('authenticate')->group(function () {
    Route::get('Category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('Category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('Category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('Category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('Category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('Category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


    Route::get('SubCategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::get('SubCategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('SubCategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('SubCategory/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('SubCategory/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('SubCategory/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');


    
    Route::get('Product', [ProductController::class, 'index'])->name('product.index'); 
    Route::get('Product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('Product', [ProductController::class, 'store'])->name('product.store'); 
    Route::get('Product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('Product/{id}', [ProductController::class, 'update'])->name('product.update'); 
    Route::delete('Product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/get-subcategories', [ProductController::class, 'getSubcategories'])->name('getSubcategories');

   Route::get('/show-user',[AuthController::class,'showUser'])->name('showUser');
   
   

});
Route::prefix('user')->name('user.')->middleware('user')->group(function () {
Route::get('User',[UserController::class,'user'])->name('user.info');
Route::get('/show-user',[UserController::class,'showUser'])->name('showuser');
Route::get('/user-edit',[UserController::class,'editUser'])->name('edituser');
Route::delete('/user-delete/{user}',[UserController::class,'delete'])->name('delete');
Route::put('/updateUser/{user}',[UserController::class,'updateUser'])->name('updateuser');



Route::get('/user/buy-now/{productId}/confirm', [CartController::class, 'buyNowConfirm'])->name('buy.now.confirm');
Route::post('/user/buy-now/{productId}', [CartController::class, 'processBuyNow'])->name('buy.now.process');
Route::get('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::delete('/user/cart/remove/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/user/done',[CartController::class,'doneOrder'])->name('doneOrder');
Route::get('/user/orders', [CartController::class, 'orders'])->name('orders');
Route::get('/user/orderDetail/{orderID}',[CartController::class,'orderDetail'])->name('orderdetail');
Route::get('/user/buy/{productId}', [CartController::class, 'buyNow'])->name('buy.now');




Route::get('/orders/{orderId}/products/{productId}/rating', [RatingController::class, 'showRating'])->name('ratings.show');
Route::post('/orders/{orderId}/products/{productId}/rate', [RatingController::class, 'store'])->name('ratings.store');




});



Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/products/search', [ProductController::class, 'searchProduct'])->name('products.search');




Route::middleware([Authenticate::class])->group(function () {
Route::get('/dashboard',[AuthController::class,'dashboard'])->name("dashboard");
Route::get('/users',[AuthController::class,'users'])->name('users');
Route::get('/users/edit/{user}', [AuthController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [AuthController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [AuthController::class, 'destroy'])->name('users.destroy');
Route::get('/home',[AuthController::class,'home'])->name('home');
Route::get('/show-user',[AuthController::class,'showUser'])->name('showuser');
Route::get('/user-edit',[AuthController::class,'editUser'])->name('edituser');
Route::delete('/user-delete/{user}',[AuthController::class,'delete'])->name('delete');
Route::put('/updateUser/{user}',[AuthController::class,'updateUser'])->name('updateuser');

});




// Route::middleware('auth')->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


 Route::get('/', [DashboardController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });
