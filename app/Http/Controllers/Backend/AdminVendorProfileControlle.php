<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileControlle extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile=Vendor::where('user_id',Auth()->user()->id)->first();
        return view('admin.vendor-profile.index',compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner'     => 'nullable|image|max:2000',
            'phone'      => 'required|max:50',
            'email'      => 'required|email|max:200',
            'address'    => 'required',
            'description'=> 'required',
            'fb_link'    => 'nullable|url',
            'tw_link'    => 'nullable|url',
            'tw_link'    => 'nullable|url',
            'insta_link' => 'nullable|url',
        ]);

        $vendor=Vendor::where('user_id',Auth::user()->id)->first();

        if ($request->hasFile('banner')) {
            $bannerPath=$this->updateImage($request,'banner','uploads',$vendor->banner);
            $vendor->banner=$bannerPath;
        }
        $vendor->phone=$request->phone;
        $vendor->email=$request->email;
        $vendor->address=$request->address;
        $vendor->description=$request->description;
        $vendor->fb_link=$request->fb_link;
        $vendor->tw_link=$request->tw_link;
        $vendor->insta_link=$request->insta_link;
        $vendor->save();
        toastr('Güncelleme başarılı','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
