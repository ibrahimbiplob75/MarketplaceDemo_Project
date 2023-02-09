<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryselect;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::get('/', [App\Http\Controllers\forntend::class, 'welcome']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product_details/{product_id}',[App\Http\Controllers\forntend::class, 'product_details'])->name('product.details');
Route::get('/contact',[App\Http\Controllers\forntend::class, 'contact']);
Route::post('/getsize',[App\Http\Controllers\forntend::class, 'getsize']);



//Dashboard
Route::get('/dashboard',[App\Http\Controllers\forntend::class, 'dashboard']);
Route::get('/logout',[App\Http\Controllers\forntend::class, 'logout']);
Route::get('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


//coutomer login

Route::post('/coustomer/login',[\App\Http\Controllers\coustomerlogincontroller::class , 'coustomer_login']);
Route::post('/coustomer/register',[\App\Http\Controllers\coustomerregiscontroller::class , 'coustomer_register']);
Route::get('/coustomer/account',[\App\Http\Controllers\coustomerregiscontroller::class , 'coustomer_account']);


//profile
Route::post('/add/user', [App\Http\Controllers\profile::class, 'add_user']);
Route::get('/user/login', [App\Http\Controllers\profile::class, 'user_login']);
Route::get('/profile/insert',[App\Http\Controllers\profile::class, 'profile_insert']);
Route::get('/profile/edit',[App\Http\Controllers\profile::class, 'profile']);
Route::post('/profile/update',[App\Http\Controllers\profile::class, 'update']);
Route::post('/password/update',[App\Http\Controllers\profile::class, 'p_update']);
Route::post('/profile/picture/update',[App\Http\Controllers\profile::class, 'profilepictureupdate']);



//category route
Route::get('/category',        [App\Http\Controllers\categoryselect::class, 'category']);
Route::post('/category/insert',[App\Http\Controllers\categoryselect::class, 'insert']);
Route::get('/category/delete/{category_id}', [App\Http\Controllers\categoryselect::class, 'delete']);
Route::get('/category/edit/{category_id}', [App\Http\Controllers\categoryselect::class, 'edit']);
Route::post('/category/update', [App\Http\Controllers\categoryselect::class, 'update']);


//subcatergoty controller
Route::get('/subcategory',[App\Http\Controllers\subcategorycontroller::class, 'index']);
Route::post('/subcategory/insert',[App\Http\Controllers\subcategorycontroller::class, 'insert']);
Route::get('/subcategory/delete/{subcategory_id}', [App\Http\Controllers\subcategorycontroller::class, 'delete']);
Route::get('/subcategory/edit/{subcategory_id}', [App\Http\Controllers\subcategorycontroller::class, 'edit']);
Route::get('/subcategory/restore/{subcategory_id}', [App\Http\Controllers\subcategorycontroller::class, 'restore']);
Route::get('/subcategory/permanent/delete/{subcategory_id}', [App\Http\Controllers\subcategorycontroller::class, 'p_delete']);
Route::post('/subcategory/update', [App\Http\Controllers\subcategorycontroller::class, 'update']);

//product controller
Route::get('/products',[App\Http\Controllers\productcontroller::class, 'index'])->name('products');
Route::post('/getsubcategory',[App\Http\Controllers\productcontroller::class, 'getsubcategory']);
Route::post('/product/insert',[App\Http\Controllers\productcontroller::class, 'product_insert']);

Route::get('/product/invetory',[App\Http\Controllers\productcontroller::class, 'product_invetory']);
Route::post('/product/color/insert',[App\Http\Controllers\productcontroller::class, 'product_color']);
Route::post('/product/size/insert',[App\Http\Controllers\productcontroller::class, 'product_size']);
Route::get('/inventory/{products_id}',[App\Http\Controllers\productcontroller::class, 'inventory'])->name('inventory');
Route::post('/inventory/insert',[App\Http\Controllers\productcontroller::class, 'inventory_insert']);

//Cart controller
Route::post('/cart/insert',[App\Http\Controllers\cartcontrollar::class,'cart_insert']);
Route::get('/cart/delete/{cart_id}',[App\Http\Controllers\cartcontrollar::class,'cart_delete'])->name('cart_delete');




