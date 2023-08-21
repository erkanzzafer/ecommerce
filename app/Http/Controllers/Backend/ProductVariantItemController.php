<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.product.variant-items.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId)
    {

        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);

        return view('admin.product.variant-items.create', compact('variant', 'product'));
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
        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }
    public function edit(string $id)
    {

        $variant = ProductVariantItem::findOrFail($id);
        return view('admin.product.variant-items.edit', compact('variant'));
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
        return redirect()->route('admin.products-variant-item.index', ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]);
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
