<?php

use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

//Vendor
Route::get('dashboard',[VendorController::class,'dashboard'])->name('vendor.dashboard');
Route::get('profile',[VendorProfileController::class,'index'])->name('profile');
Route::put('profile',[VendorProfileController::class,'updateProfile'])->name('profile.update');
Route::post('profile',[VendorProfileController::class,'updatePassword'])->name('profile.update.password');

//Vendor Profile
Route::resource('shop-profile',VendorShopProfileController::class);

//Product
Route::resource('products',VendorProductController::class);
Route::get('get-subcategory',[VendorProductController::class,'getSubCategories'])->name('get-subcategories');
Route::get('get-childcategories',[VendorProductController::class,'getChildcategories'])->name('get-childcategories');
Route::put('product-change/change-status',[VendorProductController::class,'changeStatus'])->name('product.change-status');

//ProductImageGallery
Route::get('product-image-gallery/{id}',[VendorProductImageGalleryController::class,'showTable'])->name('products-image-gallery.showTable');
Route::resource('products-image-gallery',VendorProductImageGalleryController::class);

