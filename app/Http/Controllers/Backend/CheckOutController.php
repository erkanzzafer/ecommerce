<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', 3)->get();
        $shippingRules = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingRules'));
    }

    public function createAddress(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:200',
            'phone'  => 'required|max:200',
            'email'  => 'required|email',
            'country'  => 'required|max:200',
            'state'  => 'required|max:200',
            'city'  => 'required|max:200',
            'zip'  => 'required|max:200',
            'address'  => 'required|max:200',
        ]);
        $new_address = new UserAddress();
        $new_address->name = $request->name;
        $new_address->user_id = Auth::user()->id;
        $new_address->phone = $request->phone;
        $new_address->email = $request->email;
        $new_address->country = $request->country;
        $new_address->state = $request->state;
        $new_address->city = $request->city;
        $new_address->zip = $request->zip;
        $new_address->address = $request->address;
        $new_address->save();
        toastr('Adres başarılı bir şekilde oluşturuldu', 'success');
        return redirect()->back();
    }

    public function checkOutFormSubmit(Request $request)
    {
        $request->validate([
            'shipping_method_id'   => 'required|integer',
            'shipping_address_id'  => 'required|integer',
        ]);

        $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);
        if ($shippingMethod) {
            Session::put('shipping_method', [
                'id' => $shippingMethod->id,
                'name' => $shippingMethod->name,
                'type' => $shippingMethod->type,
                'cost' => $shippingMethod->cost,
            ]);
        }

        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if ($address) {
            Session::put('address ', $address);
            Session::put('deneme','deneme');
        }
        return response(['status' => 'success', 'redirect_url'=> route('user.payment')]);
    }
}
