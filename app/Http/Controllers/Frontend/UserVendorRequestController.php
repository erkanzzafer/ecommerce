<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class UserVendorRequestController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        return view('frontend.dashboard.vendor-request.index');
    }

    public function create(Request $request)
    {

        $request->validate([
            'shop_image'  => 'required|image',
            'shop_name'   =>  'required|max:200',
            'shop_email'  => 'required|email',
            'shop_phone'  => 'required|max:20',
            'shop_address' => 'required',
            'about'       => 'required',
        ]);




        $vendor = new Vendor();
        if ($request->hasFile('shop_image')) {
            $bannerPath = $this->uploadImage($request, 'shop_image', 'uploads');
            $vendor->banner = $bannerPath;
        }
        $vendor->phone = $request->shop_phone;
        $vendor->email = $request->shop_email;
        $vendor->address = $request->shop_address;
        $vendor->description = $request->about;
        $vendor->shop_name = $request->shop_name;
        $vendor->user_id = auth()->user()->id;
        $vendor->status = 0;
        $vendor->save();

        toastr('İstek Gönderildi', 'success', 'Başarılı!');
        return redirect()->back();


    }
}