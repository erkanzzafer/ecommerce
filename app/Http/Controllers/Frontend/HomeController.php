<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory= HomePageSetting::where('key','popular_category_section')->first();
        $brands=Brand::where('status',1)->where('is_featured')->get();
        return view('frontend.home.home', compact('sliders', 'flashSaleDate', 'flashSaleItems','popularCategory','brands'));
    }
}
