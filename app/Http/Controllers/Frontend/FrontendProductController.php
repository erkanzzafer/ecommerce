<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    public function showProduct(string $slug)
    {

        $product = Product::with(['vendor', 'category', 'productImageGalleries', 'variant', 'brand'])->where('slug', $slug)->where('status', 1)->first();
        if (!is_null($product)) {
            return view('frontend.pages.product-detail', compact('product'));
        }
        abort(404);
    }


    public function productIndex(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::where([
                'status' => 1,
                'category_id' => $category->id,
                'is_approved' => 1
            ])->paginate(1);

        }else if ($request->has('subcategory')) {
            $sub_category = SubCategory::where('slug', $request->subcategory)->firstOrFail();

            $products = Product::where([
                'status' => 1,
                'sub_category_id' => $sub_category->id,
                'is_approved' => 1
            ])->paginate(12);
        }else if ($request->has('childcategory')) {
            $child_category = ChildCategory::where('slug', $request->childcategory)->firstOrFail();

            $products = Product::where([
                'status' => 1,
                'child_category_id' => $child_category->id,
                'is_approved' => 1
            ])->paginate(12);
        }else{
            abort(404);
        }


        return view('frontend.pages.product',compact('products'));
    }

    public function changeListView(Request $request){

        Session::put('product_list_style',$request->style);

    }

}
