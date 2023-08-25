<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $products = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->with('product_variantId',$variant->id)
        ->render('vendor.products.variant-item.index', compact('products', 'variant'));
    }

    public function create(string $productId, string $variantId)
    {

        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);

        return view('vendor.products.variant-item.create', compact('variant', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'variant_id'    => 'integer|required',
            'name'         => 'required|max:200',
            'price'        => 'integer|required',
            'is_default'   => 'required',
            'status'       => 'required'
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();
        toastr('Ürün ögesi başarıyla kaydedildi');
        return redirect()->route('vendor.products-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }
    public function edit(string $id)
    {

        $variant = ProductVariantItem::findOrFail($id);
        return view('vendor.products.variant-item.edit', compact('variant'));
    }

    public function update(Request $request, string $variantItemID)
    {
        $request->validate([
            'name'         => 'required|max:200',
            'price'        => 'integer|required',
            'is_default'   => 'required',
            'status'       => 'required'
        ]);

        $variantItem = ProductVariantItem::findOrFail($variantItemID);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();
        toastr('Ürün ögesi başarıyla güncellendi');
        return redirect()->route('vendor.products-variant-item.index', ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]);
    }

    public function destroy(string $id)
    {
        $variantItem=ProductVariantItem::findOrFail($id);
        $variantItem->delete();
        return response(['status'=> 'success','message'=>'Öge başarıyla silindi']);
    }

    public function changeStatus(Request $request){

        $variantItem=ProductVariantItem::findOrFail($request->id);
        $variantItem->status=$request->status=="true" ? 1 : 0;
        $variantItem->save();
        return response(['message'=>'Durum değiştirildi']);
    }
}
