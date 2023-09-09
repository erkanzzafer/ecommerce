<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cartDetails()
    {

        $cartItems = Cart::content();

        if(count($cartItems)==0){
            toastr('Sepette ürün bulunmuyor','warning','Bilgi');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);


        //check product qty
        if($product->qty == 0 ){
            return response(['status' => 'error','message' => 'Ürünü stokta yok']);
        }else if ($product->qty < $request->qty){
            return response(['status' => 'error','message' => 'İstediğiniz sayıda ürün stokta mevcut değil']);
        }

        $variants = [];
        $variantTotalAmount = 0;
        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }


        //check discount
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }
        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);
        return response(['status' => 'success', 'message' => 'Ürün sepete eklendi']);
    }



    public function updateProductQty(Request $request)
    {
        $productId= Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);
         //check product qty
         if($product->qty == 0 ){
            return response(['status' => 'error','message' => 'Ürünü stokta yok']);
        }else if ($product->qty < $request->quantity){
            return response(['status' => 'error','message' => 'İstediğiniz sayıda ürün stokta mevcut değil']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal=$this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Ürün sayısı güncellendi', 'product_total' => $productTotal ]);
    }


    //Product Total

    public function getProductTotal($rowId)
    {
        $product =    Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;

        return $total;
    }


    public function clearCart(){
        Cart::destroy();
        return response(['status' => 'success' , 'message' => 'Sepetteki ürünler kaldırıldı']);
    }

    public function removeProduct($rowId){
        Cart::remove($rowId);
        toastr('Ürün kaldırıldı','success','İşlem Başarılı');
        return redirect()->back();
    }

    public function getCartCount(){
            return Cart::content()->count();
    }

    //get all cart products
    public function getCartProducts (){
        return Cart::content();
    }

    //remove from sidebar
    public function removeSidebarProduct(Request $request){
        Cart::remove($request->rowId);
        return response(['status' => 'success' , 'message' => 'Ürün kaldırıldı']);
    }

    //get Cart Total amount
    public function cartTotal(){
        $total=0;
        foreach(Cart::content() as  $product){
            $total+=$this->getProductTotal($product->rowId);
        }
        return $total;
    }

}