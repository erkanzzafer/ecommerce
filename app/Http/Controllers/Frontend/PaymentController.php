<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    public function index()
    {


        if (!Session::has('address')) {
            return redirect()->route('user.checkout');
        }

        return view('frontend.pages.payment');
    }


    public function storeOrder($transactionId,$paidAmount,$paidCurrencyName){
        $setting=GeneralSetting::first();
        $order=new Order();
        $order->invocie_id=rand(1,999999);
        $order->user_id=Auth::user()->id;
        $order->sub_total=getMainCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name=$setting->currency_name;
        $order->currency_icon=$setting->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method='aa';
        $order->payment_status='1';
        $order->order_address= json_encode(Session::get('address'));
        $order->shipping_method=json_encode(Session::get('shipping_method'));
        $order->coupon=json_encode(Session::get('coupon'));
        $order->order_status=0;
        $order->save();

        //store order products
        foreach(Cart::content() as $item){
            $product=Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct ->order_id = $order->id;
            $orderProduct ->product_id = $item->id;
            $orderProduct ->vendor_id = $product->vendor_id;
            $orderProduct ->product_name = $product->name;
            $orderProduct ->variants = json_encode($item->options->variants);
            $orderProduct ->variant_total = $item->options->variants_total;
            $orderProduct ->unit_price = $item->price;
            $orderProduct ->qty = $item->qty;
            $orderProduct ->save();
        }

        //store transaction details
        $transaction = new Transaction();
        $transaction->order_id=$order->id;
        $transaction->transaction_id=$transactionId;
        $transaction->payment_method='1';
        $transaction->amount=getFinalPayableAmount();
        $transaction->amount_real_currency=$paidAmount;
        $transaction->amount_real_currency_name=$paidCurrencyName;

        $transaction->save();

    }


    public function clearSession(){
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }






    public function paypalConfig()
    {
        $paypalSetting = PaypalSetting::first();
        $config = [
            'mode'    => $paypalSetting->mode == 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         =>  $paypalSetting->client_id,
                'client_secret'     =>  $paypalSetting->secret_key,
                'app_id'            =>  '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   =>  true,
        ];
        return $config;
    }

    //paypal redirect
    public function payWithPaypal()
    {
/*
        $config = $this->paypalConfig();
        $paypalSetting = PaypalSetting::first();

        $provider = new PayPalClient();

        $provider->setApiCredentials($config);

        //calculate payable amount depending on currency rate
        $total = getFinalPayableAmount();
        $payableAmount=round($total*$paypalSetting->currency_rate,2);

        $response=$provider->createOrder([

                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('user.paypal.success'),
                    "cancel_url" => route('user.paypal.cancel'),
                ],
                "purchase_units" => [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value"         => $payableAmount,
                    ]

                ]
        ]);
    */
    $paypalSetting = PaypalSetting::first();
    $total=getFinalPayableAmount();
    $paidAmount=round($total*$paypalSetting->currency_rate,2);
    $this->storeOrder(1,$paidAmount,$paypalSetting->currency_name);
    $this->clearSession();
    return view('frontend.pages.payment-success');
    }
}
