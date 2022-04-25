<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeMenController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{id}', [HomeController::class, 'productsByCat']);
Route::get('/product/{id}', [HomeController::class, 'product']);

Route::get('/getActions', [ActionController::class, 'getActions']);

Route::get('/getCategories', [CategoryController::class, 'getCategories']);

Route::get('/getProducts/{id}', [ProductController::class, 'getProducts']);
Route::get('/getProduct/{id}', [ProductController::class, 'getProduct']);

Route::get('/getComments/{id}', [CommentController::class, 'getComments']);

Route::get('/blogPage', [BlogController::class, 'blogPage']);
Route::get('/getAllBlogs', [BlogController::class, 'getAllBlogs']);
Route::get('/blogView/{id}', [BlogController::class, 'blogView']);
Route::get('/getBlog/{id}', [BlogController::class, 'getBlog']);

Route::post('/sendMessage', [EmailController::class, 'sendMessage']);


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
    Route::get('/register', [AuthController::class, 'registerIndex']);
    Route::post('/registration', [AuthController::class, 'register']);
    Route::post('/login_in', [AuthController::class, 'login']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/buy', [CheckoutController::class, 'buyProducts']);
    Route::post('/updatePoints', [CheckoutController::class, 'updatePoints']);
    Route::get('/ck', [CheckoutController::class, 'getCheckoutByUser']);
    Route::delete('/deleteCK/{id}', [CheckoutController::class, 'deleteCheckout']);

    Route::get('/points', [AuthController::class, 'getPoints']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/getUserAuth', [AuthController::class, 'getUserAuth']);
    Route::post('/changePass', [AuthController::class, 'changePass']);

    Route::post('/comment', [CommentController::class, 'comment']);
    Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment']);
    
});


Route::middleware(['admin'])->group(function () {
    Route::get('/users', [AuthController::class, 'users']);
    Route::get('/getUsers', [AuthController::class, 'getUsers']);
    Route::get('/getRoles', [AuthController::class, 'getRoles']);
    Route::post('/createUser', [AuthController::class, 'createUser']);
    Route::post('/editUser', [AuthController::class, 'editUser']);
    Route::delete('/deleteUser/{id}', [AuthController::class, 'deleteUser']);
    Route::post('/postaviSesijuRole', [AuthController::class, 'postaviSesijuRole']);

    Route::get('/categories', [CategoryController::class, 'categories']);
    Route::post('/createCat', [CategoryController::class, 'createCat']);
    Route::post('/editCat', [CategoryController::class, 'editCat']);
    Route::delete('/deleteCat/{id}', [CategoryController::class, 'deleteCat']);

    Route::get('/category/{id}', [ProductController::class, 'products']);
    Route::get('/getPro/{id}', [ProductController::class, 'getProducts1']);
    Route::post('/createProduct', [ProductController::class, 'createProduct']);
    Route::post('/editProduct', [ProductController::class, 'editProduct']);
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'deleteProduct']);

    Route::get('/homeAdmin', [HomeAdminController::class, 'index']);
    Route::get('/countUsers', [HomeAdminController::class, 'countUsers']);
    Route::get('/countCat', [HomeAdminController::class, 'countCat']);
    Route::get('/countProducts', [HomeAdminController::class, 'countProducts']);
    Route::get('/lastUser', [HomeAdminController::class, 'lastUser']);
    Route::get('/lastCat', [HomeAdminController::class, 'lastCat']);
    Route::get('/lastProduct', [HomeAdminController::class, 'lastProduct']);

});


Route::middleware(['men'])->group(function () {
    Route::get('/homeMen', [HomeMenController::class, 'index']);

    Route::get('/blogsMen', [BlogController::class, 'index']);
    Route::post('/createBlog', [BlogController::class, 'createBlog']);
    Route::get('/getBlogs', [BlogController::class, 'getBlogs']);
    Route::post('/editBlog', [BlogController::class, 'editBlog']);
    Route::delete('/deleteBlog/{id}', [BlogController::class, 'deleteBlog']);
    Route::get('/blog/{id}', [BlogController::class, 'blog']);

    Route::get('/allCheck', [CheckoutController::class, 'allCheck']);
    Route::get('/getCheck', [CheckoutController::class, 'getCheck']);
    Route::delete('/deleteCKMen/{id}', [CheckoutController::class, 'deleteCheckMen']);

    Route::get('/messages', [EmailController::class, 'index']);
    Route::get('/getMessages', [EmailController::class, 'getMessages']);
    Route::get('/message/{id}', [EmailController::class, 'message']);
    Route::get('/getMessage/{id}', [EmailController::class, 'getMessage']);

});
