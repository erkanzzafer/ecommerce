<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        return view('frontend.pages.wishlist');
    }

    public function addToWishlist(Request $request){

            if(!Auth::check()){
                return response(['status' => 'error' , 'message' => 'Login Olmalısınız!']);
            }
            $wishlistCount = Wishlist::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
            if ($wishlistCount >0 ){
                return response(['status' => 'error' , 'message'  => 'Ürün zaten ekli!']);
            }

            $wishlist =Wishlist::create([
                'product_id' => $request->id,
                'user_id' => Auth::user()->id
            ]);

            return response(['status' => 'success' , 'message' => 'Ürün eklendi']);
    }

}
