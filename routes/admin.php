<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileControlle;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

//Admin
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::post('logout',[AdminController::class,'logout'])->name('logout');


//Profile
Route::get('profile',[ProfileController::class,'index'])->name('profile');
Route::post('profile/update',[ProfileController::class,'updateProfile'])->name('profile.updateProfile');
Route::post('profile/update/password',[ProfileController::class,'updatePassword'])->name('password.updatePassword');

//Slider
Route::resource('slider',SliderController::class);

//Category
Route::resource('category',CategoryController::class);
Route::put('change-status',[CategoryController::class,'changeStatus'])->name('category.change-status');

//SubCategory
Route::resource('subcategory',SubCategoryController::class);
Route::put('subcategory-change/change-status',[SubCategoryController::class,'changeStatus'])->name('subcategory.change-status');

//ChildCategory
Route::resource('childcategory',ChildCategoryController::class);
Route::put('childcategory-change/change-status',[ChildCategoryController::class,'changeStatus'])->name('childcategory.change-status');
Route::get('get-subcategory',[ChildCategoryController::class,'getSubCategories'])->name('get-subcategories');
Route::get('get-childcategories',[ChildCategoryController::class,'getChildcategories'])->name('get-childcategories');


//Brand
Route::resource('brand',BrandController::class);
Route::put('brand-change/change-status',[BrandController::class,'changeStatus'])->name('brand.change-status');


//Vendor Profile
Route::resource('vendor-profile',AdminVendorProfileControlle::class);

//Product
Route::resource('product',ProductController::class);
Route::put('product-change/change-status',[ProductController::class,'changeStatus'])->name('product.change-status');
Route::resource('products-image-gallery', ProductImageGalleryController::class);
