<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

//Login Register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //admin

    Route::middleware(['admin_auth'])->group(function(){
        //category
        Route::prefix('category')->group(function(){
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createpage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            //account info
            Route::get('details', [AdminController::class, 'details'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            //admin lists
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}', [AdminController::class, 'change'])->name('admin#change');
            Route::get('ajaxChange/role',[AdminController::class, 'ajaxChangeRole'])->name('admin#ajaxChangeRole');

        });

        //products
        Route::prefix('products')->group(function(){
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });

        //orders
        Route::prefix('order')->group(function(){
            Route::get('list', [OrderController::class, 'list'])->name('order#list');
            Route::get('/status', [OrderController::class, 'Status'])->name('order#Status');
            Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('order#ajaxChangeStatus');
            Route::get('info/{orderCode}', [OrderController::class, 'info'])->name('order#info');
        });

        //users
        Route::prefix('user')->group(function(){
            Route::get('list', [UserController::class, 'list'])->name('user#list');
            Route::get('change/role', [UserController::class, 'changeRole'])->name('user#changeRole');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('user#delete');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('user#edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('user#update');
        });

        //contact
        Route::prefix('contact')->group(function(){
            Route::get('list', [ContactController::class, 'list'])->name('contact#list');;
        });
    });


    //user
    //home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

        Route::get('/home', [UserController::class, 'home'])->name('user#home');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('/history', [UserController::class, 'history'])->name('user#history');

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });

        Route::prefix('cart')->group(function () {
            Route::get('list', [UserController::class,'cartList'])->name('user#cartList');
        });


        //change password
        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        //user profile
        Route::prefix('account')->group(function () {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}', [UserController::class, 'accountChange'])->name('user#accountChange');
        });

        //ajax
        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList',[AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clear'])->name('ajax#clearCart');
            Route::get('clear/current/product', [AjaxController::class, 'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount', [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');

        });

        //contact
        Route::prefix('contact')->group(function(){
            Route::get('show/list', [ContactController::class, 'showList'])->name('contact#showList');
            Route::post('add/list', [ContactController::class, 'addList'])->name('contact#addList');
        });
});


});

Route::get('webTesting', function(){
    $data = [
        'message' => 'Hello web testing'
    ];
    return response()->json($data, 200);
});
