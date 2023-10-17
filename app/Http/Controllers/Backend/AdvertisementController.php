<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $homepage_section_banner_one = Advertisement::where('key', 'homepage_section_banner_one')->first();
        $homepage_section_banner_one = json_decode($homepage_section_banner_one->value);

        $homepage_section_banner_two = Advertisement::where('key', 'homepage_section_banner_two')->first();
        $homepage_section_banner_two = json_decode($homepage_section_banner_two?->value);

        $homepage_section_banner_three = Advertisement::where('key', 'homepage_section_banner_three')->first();
        $homepage_section_banner_three = json_decode($homepage_section_banner_three?->value);

        $homepage_section_banner_four = Advertisement::where('key', 'homepage_section_banner_four')->first();
        $homepage_section_banner_four = json_decode($homepage_section_banner_four?->value);

        $productpage_banner_section = Advertisement::where('key', 'productpage_banner_section')->first();
        $productpage_banner_section = json_decode($productpage_banner_section?->value);

        $cartpage_banner_section = Advertisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);

        return view('admin.advertisement.index', compact('homepage_section_banner_one', 'homepage_section_banner_two', 'homepage_section_banner_three','homepage_section_banner_four','productpage_banner_section','cartpage_banner_section'));
    }


    public function homepageBannerSectionOne(Request $request)
    {

        $request->validate([
            'banner_image' => 'sometimes|image',
            'banner_url' => 'required'
        ]);


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_url,
                'status'    => $request->status == 'on' ? 1 : 0,
            ]
        ];
        if ($request->has('banner_image')) {
            $imagePath = $this->updateImage($request, 'banner_image', 'uploads');
            $value['banner_one']['banner_image'] = $imagePath;
        } else {
            $value['banner_one']['banner_image'] = $request->banner_old_image;
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_section_banner_one'],
            ['value' => $value]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı!');
        return redirect()->back();
    }


    public function homepageBannerSectionTwo(Request $request)
    {

        $request->validate([
            'banner_one_image' => 'sometimes|image',
            'banner_one_url' => 'required',
            'banner_two_image' => 'sometimes|image',
            'banner_two_url' => 'required'
        ]);


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_one_url,
                'status'    => $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two' => [
                'banner_url' => $request->banner_two_url,
                'status'    => $request->banner_two_status == 'on' ? 1 : 0,
            ]
        ];
        if ($request->has('banner_one_image')) {
            $imagePath = $this->updateImage($request, 'banner_one_image', 'uploads');
            $value['banner_one']['banner_one_image'] = $imagePath;
        } else {
            $value['banner_one']['banner_one_image'] = $request->banner_one_old_image;
        }

        if ($request->has('banner_two_image')) {
            $imagePathTwo = $this->updateImage($request, 'banner_two_image', 'uploads');
            $value['banner_two']['banner_two_image'] = $imagePathTwo;
        } else {
            $value['banner_two']['banner_two_image'] = $request->banner_two_old_image;
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_section_banner_two'],
            ['value' => $value]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı!');
        return redirect()->back();
    }


    public function homepageBannerSectionThree(Request $request)
    {

        $request->validate([
            'banner_one_image' => 'sometimes|image',
            'banner_one_url' => 'required',
            'banner_two_image' => 'sometimes|image',
            'banner_two_url' => 'required',
            'banner_three_image' => 'sometimes|image',
            'banner_three_url' => 'required'
        ]);


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_one_url,
                'status'    => $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two' => [
                'banner_url' => $request->banner_two_url,
                'status'    => $request->banner_two_status == 'on' ? 1 : 0,
            ],
            'banner_three' => [
                'banner_url' => $request->banner_three_url,
                'status'    => $request->banner_three_status == 'on' ? 1 : 0,
            ]
        ];
        if ($request->has('banner_one_image')) {
            $imagePath = $this->updateImage($request, 'banner_one_image', 'uploads');
            $value['banner_one']['banner_one_image'] = $imagePath;
        } else {
            $value['banner_one']['banner_one_image'] = $request->banner_one_old_image;
        }

        if ($request->has('banner_two_image')) {
            $imagePathTwo = $this->updateImage($request, 'banner_two_image', 'uploads');
            $value['banner_two']['banner_two_image'] = $imagePathTwo;
        } else {
            $value['banner_two']['banner_two_image'] = $request->banner_two_old_image;
        }

        if ($request->has('banner_three_image')) {
            $imagePathThree = $this->updateImage($request, 'banner_three_image', 'uploads');
            $value['banner_three']['banner_three_image'] = $imagePathThree;
        } else {
            $value['banner_three']['banner_three_image'] = $request->banner_three_old_image;
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_section_banner_three'],
            ['value' => $value]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı!');
        return redirect()->back();
    }


    public function homepageBannerSectionFour(Request $request)
    {
        $request->validate([
            'banner_image' => 'sometimes|image',
            'banner_url' => 'required'
        ]);


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        $value = [
            'banner_four' => [
                'banner_url' => $request->banner_url,
                'status'    => $request->status == 'on' ? 1 : 0,
            ]
        ];
        if ($request->has('banner_four_image')) {
            $imagePathFour = $this->updateImage($request, 'banner_four_image', 'uploads');
            $value['banner_four']['banner_four_image'] = $imagePathFour;
        } else {
            $value['banner_four']['banner_four_image'] = $request->banner_four_old_image;
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_section_banner_four'],
            ['value' => $value]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı!');
        return redirect()->back();
    }

    public function productPageBanner(Request $request){
        $request->validate([
            'banner_image' => 'sometimes|image',
            'banner_url' => 'required'
        ]);


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        $value = [
            'product_banner' => [
                'banner_url' => $request->banner_url,
                'status'    => $request->status == 'on' ? 1 : 0,
            ]
        ];
        if ($request->has('banner_image')) {
            $imagePathProduct = $this->updateImage($request, 'banner_image', 'uploads');
            $value['product_banner']['banner_product_image'] = $imagePathProduct;
        } else {
            $value['product_banner']['banner_product_image'] = $request->product_banner_old_image;
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'productpage_banner_section'],
            ['value' => $value]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı!');
        return redirect()->back();
    }


    public function cartPageBanner(Request $request){
        $request->validate([
            'banner_image_one' => 'sometimes|image',
            'banner_url_one' => 'required',
            'banner_image_two' => 'sometimes|image',
            'banner_url_two' => 'required'
        ]);


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        $value = [
            'cart_banner_one' => [
                'banner_url' => $request->banner_url_one,
                'status'    => $request->status_one == 'on' ? 1 : 0,
            ],
            'cart_banner_two' => [
                'banner_url' => $request->banner_url_two,
                'status'    => $request->status_two == 'on' ? 1 : 0,
            ]
        ];
        if ($request->has('banner_image_one')) {
            $imagePathCartOne = $this->updateImage($request, 'banner_image_one', 'uploads');
            $value['cart_banner_one']['banner_image_one'] = $imagePathCartOne;
        } else {
            $value['cart_banner_one']['banner_image_one'] = $request->cart_banner_old_image_one;
        }


        // 'banner_image' => empty(!$imagePath) ? $imagePath : $request->banner_image;
        if ($request->has('banner_image_two')) {
            $imagePathCartTwo = $this->updateImage($request, 'banner_image_two', 'uploads');
            $value['cart_banner_two']['banner_image_two'] = $imagePathCartTwo;
        } else {
            $value['cart_banner_two']['banner_image_two'] = $request->cart_banner_old_image_two;
        }



        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'cartpage_banner_section'],
            ['value' => $value]
        );

        toastr('Güncelleme Başarılı', 'success', 'Başarılı!');
        return redirect()->back();
    }
}
