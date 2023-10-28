<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProduct = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        //advertisement banners
        $homepage_section_banner_one = Advertisement::where('key', 'homepage_section_banner_one')->first();
        $homepage_section_banner_one = json_decode($homepage_section_banner_one->value);

        $homepage_section_banner_two = Advertisement::where('key', 'homepage_section_banner_two')->first();
        $homepage_section_banner_two = json_decode($homepage_section_banner_two?->value);

        $homepage_section_banner_three = Advertisement::where('key', 'homepage_section_banner_three')->first();
        $homepage_section_banner_three = json_decode($homepage_section_banner_three?->value);

        $homepage_section_banner_four = Advertisement::where('key', 'homepage_section_banner_four')->first();
        $homepage_section_banner_four = json_decode($homepage_section_banner_four?->value);
        return view('frontend.home.home', compact(
            'sliders',
            'flashSaleDate',
            'flashSaleItems',
            'popularCategory',
            'brands',
            'typeBaseProduct',
            'categoryProductSliderSectionOne',
            'categoryProductSliderSectionTwo',
            'categoryProductSliderSectionThree',
            'homepage_section_banner_one',
            'homepage_section_banner_two',
            'homepage_section_banner_three',
            'homepage_section_banner_four'
        ));
    }


    public function getTypeBaseProduct()
    {
        $typeBaseProduct = [];
        $typeBaseProduct['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['featured'] = Product::where(['product_type' => 'featured', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['top_product'] = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['best_product'] = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        return $typeBaseProduct;
    }

    public function vendorPage()
    {
        $vendors = Vendor::where('status',1)->paginate(20);
        return view('frontend.pages.vendor', compact('vendors'));
    }

    public function vendorProductsPage(Request $request, string $id)
    {


        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->orderBy('id', 'DESC')->paginate(12);

        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();

        $vendor=Vendor::findOrFail($id);

        return view('frontend.pages.vendor-product', compact('products', 'categories', 'brands','vendor'));
    }
}
