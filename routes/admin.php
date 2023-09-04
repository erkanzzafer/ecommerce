<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileControlle;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
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
//Product İmage
Route::resource('products-image-gallery', ProductImageGalleryController::class);
//Product Variant
Route::resource('products-variant', ProductVariantController::class);
Route::put('products-variant-change/change-status',[ProductVariantController::class,'changeStatus'])->name('products-variant.change-status');
Route::get('products-variant-index/{id}',[ProductVariantController::class,'showTable'])->name('products-variant.showTable');

//Product Variant Items
Route::get('products-variant-item/{productId}/{variantId}',[ProductVariantItemController::class,'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}',[ProductVariantItemController::class,'create'])->name('products-variant-item.create');
Route::post('products-variant-item',[ProductVariantItemController::class,'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemId}',[ProductVariantItemController::class,'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}',[ProductVariantItemController::class,'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}',[ProductVariantItemController::class,'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item',[ProductVariantItemController::class,'changeStatus'])->name('products-variant-item.change-status');

//Seller Products
Route::get('seller-products', [SellerProductController::class,'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class,'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class,'changeApproveStatus'])->name('change-approve-satus');

//Flash Sale
Route::get('flash-sale',[FlashSaleController::class,'index'])->name('flash-sale.index');
Route::put('flash-sale',[FlashSaleController::class,'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product',[FlashSaleController::class,'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/change-status',[FlashSaleController::class,'changeShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-status',[FlashSaleController::class,'changeStatus'])->name('flash-sale-status.change-status');
Route::delete('flash-sale-delete/{id}',[FlashSaleController::class,'destroy'])->name('flash-sale-status.destroy');

//Genel Ayarlar
Route::get('settings',[SettingController::class,'index'])->name('setting.index');
Route::put('general-setting-update',[SettingController::class,'generalSettingUpdate'])->name('general-setting-update');

//Kupon
Route::resource('coupons',CouponController::class);
Route::put('coupons-status',[CouponController::class,'changeStatus'])->name('coupons.change-status');
