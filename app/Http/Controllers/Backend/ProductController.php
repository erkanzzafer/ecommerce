<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $brands=Brand::all();
        return view('admin.product.create',compact(['categories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'              => 'image|required|max:3000',
            'name'               => 'required|max:200',
            'category'           => 'required',
            'brand'              => 'required',
            'price'              => 'required',
            'qty'                => 'required',
            'short_description'  => 'required|max:600',
            'long_description'   => 'required',
            'product_type'       => 'required',
            'seo_title'          => 'nullable|max:200',
            'seo_description'    => 'nullable|max:250',
            'status'             => 'required'

        ]);

        $product = new Product();
        $imagePath=$this->uploadImage($request,'image','upload');
        $product->thumb_image=$imagePath;
        $product->name=$request->name;
        $product->slug=Str::slug($request->name);
        $product->vendor_id=Auth::user()->id;
        $product->category_id=$request->category;
        $product->sub_category_id=$request->sub_category;
        $product->child_category_id=$request->child_category;
        $product->brand_id=$request->brand;
        $product->qty=$request->qty;
        $product->short_description=$request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link= $request->video_link;
        $product->sku=$request->sku;
        $product->price=$request->price;
        $product->offer_price= $request->offer_price;
        $product->offer_start_date=$request->offer_start_date;
        $product->offer_end_date=$request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status=$request->status;
        $product->is_approved= 1;
        $product->seo_title=$request->seo_title;
        $product->seo_description= $request->seo_description;
        $product->save();
        toastr('Ürün başarıyla kaydedildi','success');
        return redirect()->route('admin.product.index');
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
