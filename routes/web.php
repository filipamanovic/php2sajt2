<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Index page
Route::get('/', 'IndexController@indexPage');
Route::get('/sortProducts', 'IndexController@sortProduct')->name('sortProduct');

//Product page
Route::get('/product/{id}', 'ProductPageController@productInfo');
Route::post('/updateViews', 'ProductPageController@updateViews');
Route::post('/commentInsert', 'ProductPageController@insertComment')->name('comment');

//Registration
Route::get('/register', 'UserController@registerView');
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/verifyEmail/{token}', 'UserController@verifyEmail');
Route::get("/logout", function() {
    session()->forget("user");
    return redirect('/');
})->name("logout");

//User page
Route::get('/user/{user}', 'UserPageController@index')->name('user')->middleware('user');
Route::post('/product', 'UserPageController@insertProduct')->name('productInsert');
Route::post('/productInfo', 'UserPageController@getUpdateInfo');
Route::post('/productUpdate', 'UserPageController@productUpdate')->name('productUpdate');
Route::post('/productDelete', 'UserPageController@productDelete')->name('productDelete');

//Author
Route::get('/author', function (){
   return view('front.pages.author');
})->name('author');


//Admin rute

Route::group(['middleware' => 'admin'], function() {
    //User
    Route::resource('/admin/user', 'Admin\UserController');
    Route::post('/admin/user/updatePodaci', 'Admin\UserController@updatePodaci');
    Route::post('/admin/user/updateUser', 'Admin\UserController@updateUser');
    Route::post('/admin/user/deleteUser', 'Admin\UserController@deleteUser');

    //Comment
    Route::get('/admin/comment/index', 'Admin\CommentController@indexPage');
    Route::post('/admin/comment/insert', 'Admin\CommentController@insert')->name('comment_insert');
    Route::post('/admin/comment/updatePodaci', 'Admin\CommentController@updatePodaci');
    Route::post('/admin/user/updateComment', 'Admin\CommentController@updateComment')->name('commnet_update');
    Route::post('/admin/comment/deleteComment', 'Admin\CommentController@deleteComment');

    //Product
    Route::get('/admin/product/index', 'Admin\ProductController@indexPage');
    Route::post('/admin/product/insert', 'Admin\ProductController@insert')->name('product_insert');
    Route::post('/admin/product/updatePodaci', 'Admin\ProductController@updatePodaci');
    Route::post('/admin/product/updateProduct', 'Admin\ProductController@updateProduct')->name('product_update');
    Route::post('/admin/product/deleteProduct', 'Admin\ProductController@deleteProduct');

});