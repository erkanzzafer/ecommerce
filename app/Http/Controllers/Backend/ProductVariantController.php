<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function showTable($id,ProductVariantDataTable $dataTable){
        $product=Product::find($id);

        return $dataTable->with('productId',$id)
            ->render('admin.product.variant.index',compact('product'));
    }

    public function index(ProductVariantDataTable $dataTable,Request $request)
    {
        $product=Product::find($request->product);
        return $dataTable->render('admin.product.variant.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.variant.create');
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
       return redirect()->route('admin.products-variant.showTable',$variant->product_id);
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
        $product_variant= ProductVariant::findOrFail($id);

        return view('admin.product.variant.edit',compact('product_variant'));
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

           $variant= ProductVariant::findOrFail($id);
           $variant->name=$request->name;
           $variant->status=$request->status;
           $variant->save();
           toastr('Varyant başarıyla güncellendi','success');
           return redirect()->route('admin.products-variant.showTable',$variant->product_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_variant=ProductVariant::findOrFail($id);
        $varinatItemCheck=ProductVariantItem::where('product_variant_id',$product_variant->id)->count();
        if ($varinatItemCheck>0){
            return response(['status'=> 'error','message'  => 'Bu varyant, varyant ogeleri içerdiği için silinemez']);
        }
        $product_variant->delete();
        return response(['status'=> 'success','message'  => 'Başarıyla Silindi']);
    }

    public function changeStatus (Request $request){
        $product_variant=ProductVariant::findOrFail($request->id);
        $product_variant->status=$request->status=="true" ? 1 : 0;
        $product_variant->save();
        return response(['message'=>'Durum değiştirildi']);
    }
}
