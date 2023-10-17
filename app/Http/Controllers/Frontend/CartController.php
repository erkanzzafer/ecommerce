<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cartDetails()
    {

        $cartItems = Cart::content();

        if (count($cartItems) == 0) {
            Session::forget('coupon');
            toastr('Sepette ürün bulunmuyor', 'warning', 'Bilgi');
            return redirect()->route('home');
        }

        $cartpage_banner_section = Advertisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);
        return view('frontend.pages.cart-detail', compact('cartItems','cartpage_banner_section'));
    }


    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);


        //check product qty
        if ($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Ürünü stokta yok']);
        } else if ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'İstediğiniz sayıda ürün stokta mevcut değil']);
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
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);
        //check product qty
        if ($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Ürünü stokta yok']);
        } else if ($product->qty < $request->quantity) {
            return response(['status' => 'error', 'message' => 'İstediğiniz sayıda ürün stokta mevcut değil']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Ürün sayısı güncellendi', 'product_total' => $productTotal]);
    }


    //Product Total

    public function getProductTotal($rowId)
    {
        $product =    Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;

        return $total;
    }


    public function clearCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Sepetteki ürünler kaldırıldı']);
    }

    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Ürün kaldırıldı', 'success', 'İşlem Başarılı');
        return redirect()->back();
    }

    public function getCartCount()
    {
        return Cart::content()->count();
    }

    //get all cart products
    public function getCartProducts()
    {
        return Cart::content();
    }

    //remove from sidebar
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Ürün kaldırıldı']);
    }

    //get Cart Total amount
    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as  $product) {
            $total += $this->getProductTotal($product->rowId);
        }
        return $total;
    }


    //apply coupon
    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code == null) {
            return response(['status' => 'error', 'message' => 'Lütfen kupon giriniz!']);
        }
        //dd($request->all());
        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        //dd($coupon);
        if ($coupon == null) {
            return response(['status' => 'error', 'message' => 'Kupon tanımlı değil!']);
        } elseif ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Kupon henüz yayında değil!']);
        } elseif ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Kupon süresi doldmuş!']);
        } elseif ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'Kupon kullanılmış. Uygulayamazsınız!']);
        }

        if ($coupon->discount_type == 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount_value
            ]);
        } elseif ($coupon->discount_type == 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount_value
            ]);
        }
        return response(['status' => 'success', 'message' => 'Kupon başarıyla Uygulandı']);
    }




    //calculate coupon discount
    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if ($coupon['discount_type'] == 'amount') {
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            } elseif ($coupon['discount_type'] == 'percent') {
                $discount =  $subTotal - ( $subTotal * $coupon['discount'] / 100);
                $total =  $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }
        }else{
            $total=getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' =>0]);
        }
    }




}
