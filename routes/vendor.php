<?php


use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
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

//Product Variant
Route::resource('products-variant', VendorProductVariantController::class);
Route::get('products-variant-index/{id}',[VendorProductVariantController::class,'showTable'])->name('products-variant.showTable');
Route::put('product-variant-change/change-status',[VendorProductVariantController::class,'changeStatus'])->name('product-variant.change-status');

//Product Variant Items
Route::get('products-variant-item/{productId}/{variantId}',[VendorProductVariantItemController::class,'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}',[VendorProductVariantItemController::class,'create'])->name('products-variant-item.create');
Route::post('products-variant-item',[VendorProductVariantItemController::class,'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemId}',[VendorProductVariantItemController::class,'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}',[VendorProductVariantItemController::class,'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}',[VendorProductVariantItemController::class,'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status',[VendorProductVariantItemController::class,'changeStatus'])->name('products-variant-item.change-status');
