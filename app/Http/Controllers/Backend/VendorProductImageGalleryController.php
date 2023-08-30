<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function showTable($id,VendorProductImageGalleryDataTable $dataTable){

        $product=Product::findorFail($id);

        if($product->vendor_id!= Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTable->with('productId',$id)
            ->render('vendor.products.image-gallery.index',compact('product'));
    }

    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product=Product::find($request->product);
        return $dataTable->render('vendor.products.image-gallery.index',compact('product'));
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
            'images.*' => 'required|image|max:2048',
        ]);

        $imagePaths=$this->uploadMultiImage($request,'images','upload');
        foreach($imagePaths as $path){
            $productImageGallery=new ProductImageGallery();
            $productImageGallery->image = $path;
            $productImageGallery->product_id=$request->product;
            $productImageGallery->save();
        }
        toastr('Fotoğraflar başarıyla yüklendi','success');
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
        $productImage=ProductImageGallery::findOrFail($id);
        if($productImage->product->vendor_id!= Auth::user()->vendor->id){
            abort(404);
        }
        $this->deleteImage($productImage->image);
        $productImage->delete();
        return response(['status'=> 'success','message'  => 'Başarıyla Silindi']);
    }
}
