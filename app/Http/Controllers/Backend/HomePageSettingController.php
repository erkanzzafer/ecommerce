<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $popularCategoriesSection = HomePageSetting::where('key', 'popular_category_section')->first();
        $sliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $sliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $sliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        return view('admin.home-page-setting.index', compact(['categories', 'popularCategoriesSection', 'sliderSectionOne', 'sliderSectionTwo','sliderSectionThree']));
    }

    public function updatePopularCategorySection(Request $request)
    {

        $datas = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one,
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two,
            ],
            [
                'category' => $request->cat_three,
                'sub_category' => $request->sub_cat_three,
                'child_category' => $request->child_cat_three,
            ],
            [
                'category' => $request->cat_four,
                'sub_category' => $request->sub_cat_four,
                'child_category' => $request->child_cat_four,
            ],
        ];
        HomePageSetting::updateOrCreate(
            [
                'key' => 'popular_category_section',
            ],
            [
                'value' => json_encode($datas)
            ]
        );

        toastr('Güncelle Başarılı', 'success');
        return redirect()->back();
    }

    public function updateProductSliderSectionOne(Request $request)
    {
        $datas = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];
        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_one',
            ],
            [
                'value' => json_encode($datas)
            ]
        );

        toastr('Güncelle Başarılı', 'success');
        return redirect()->back();
    }

    public function updateProductSliderSectionTwo(Request $request)
    {
        $datas = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];
        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_two',
            ],
            [
                'value' => json_encode($datas)
            ]
        );

        toastr('Güncelle Başarılı', 'success');
        return redirect()->back();
    }

    public function updateProductSliderSectionThree(Request $request)
    {
        $request->validate([
            'cat_one' => 'required',
            'cat_two' => 'required'
        ], [
            'cat_one.required' => 'Part 1 Kategori alanı zorunludur',
            'cat_two.required' => 'Part 2 Kategori alanı zorunludur'
        ]);

        $datas = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one,
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two,
            ]
        ];
        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_three',
            ],
            [
                'value' => json_encode($datas)
            ]
        );

        toastr('Güncelle Başarılı', 'success');
        return redirect()->back();
    }
}
