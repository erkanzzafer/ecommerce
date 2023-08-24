<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function showTable($id,VendorProductVariantDataTable $dataTable){

        $products=Product::find($id);
        return $dataTable->with('productId',$id)
            ->render('vendor.products.variant.index',compact('products'));
    }

    public function index(VendorProductVariantDataTable $dataTable, Request $request)
    {

        $products=Product::find($request->product);
        return $dataTable->render('vendor.products.variant.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.products.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:200',
            'product_id' => 'integer|required',
            'status'  => 'required'
           ]);

           $variant= new ProductVariant();
           $variant->name=$request->name;
           $variant->product_id=$request->product_id;
           $variant->status=$request->status;
           $variant->save();
           toastr('Varyant başarıyla kaydedildi','success');
           return redirect()->route('vendor.products-variant.index',['product'=> $variant->product_id]);
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
        $product=ProductVariant::findOrFail($id);
        return view('vendor.products.variant.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'    => 'required|max:200',
            'status'  => 'required'
           ]);

           $variant=ProductVariant::findOrFail($id);
           $variant->name=$request->name;

           $variant->status=$request->status;
           $variant->save();
           toastr('Varyant başarıyla kaydedildi','success');
           return redirect()->route('vendor.products-variant.showTable',$variant->product_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_variant=ProductVariant::findOrFail($id);
        $product_variant->delete();
        return response(['status'=> 'success','message'  => 'Başarıyla Silindi']);
    }

     public function changeStatus(Request $request)
    {
        $product = ProductVariant::findOrFail($request->id);
        $product->status = $request->status == "true" ? 1 : 0;
        $product->save();
        return response(['message' => 'Durum değiştirildi']);
    }
}
