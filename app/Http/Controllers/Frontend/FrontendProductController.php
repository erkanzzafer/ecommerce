<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
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
        // dd($request->all());
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::where([
                'status' => 1,
                'category_id' => $category->id,
                'is_approved' => 1
            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $min = $price[0];
                    $max = $price[1];
                    return $query->where('price', '>=', $min)->where('price', '<=', $max);
                })
                ->paginate(12);
        } else if ($request->has('subcategory')) {
            $sub_category = SubCategory::where('slug', $request->subcategory)->firstOrFail();

            $products = Product::where([
                'status' => 1,
                'sub_category_id' => $sub_category->id,
                'is_approved' => 1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price = explode(';', $request->range);
                $min = $price[0];
                $max = $price[1];

                $query->where('price', '>=', $min)->where('price', '<=', $max);
            })
                ->when($request->has('brand'), function ($query) use ($request) {
                    $brand = Brand::where('slug', $request->brand)->firstOrFail();
                    return  $query->where('brand_id', $brand->id);
                })
                ->paginate(12);
        } else if ($request->has('childcategory')) {
            $child_category = ChildCategory::where('slug', $request->childcategory)->firstOrFail();

            $products = Product::where([
                'status' => 1,
                'child_category_id' => $child_category->id,
                'is_approved' => 1
            ])->when($request->has('range'), function ($query) use ($request) {
                $price = explode(';', $request->range);
                $min = $price[0];
                $max = $price[1];

                $query->where('price', '>=', $min)->where('price', '<=', $max);
            })
                ->paginate(12);
        } else if ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();

            $products = Product::where([
                'brand_id' => $brand->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $min = $price[0];
                    $max = $price[1];

                    $query->where('price', '>=', $min)->where('price', '<=', $max);
                })
                ->paginate(12);
        } else if ($request->has('search')) {
            $products = Product::where(['status'=> 1, 'is_approved' => 1])
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('long_description','like', '%' . $request->search . '%')
                ->orWhereHas('category',function($query) use ($request){
                    $query->where('name','like','%'.$request->search.'%')
                    ->orWhere('long_description','like', '%' . $request->search . '%');
                });
            })
            ->paginate(12);
        } else {
            //abort(404);
            $products=Product::where(['status'=> 1,'is_approved' => 1])->orderBy('id','DESC')->paginate(12);
        }


        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();
        return view('frontend.pages.product', compact('products', 'categories', 'brands'));
    }

    public function changeListView(Request $request)
    {

        Session::put('product_list_style', $request->style);
    }
}
