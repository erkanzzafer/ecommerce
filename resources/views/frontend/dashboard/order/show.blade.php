@php
    $address = json_decode($order->order_address);
    $shipping= json_decode($order->shipping_method);
    $coupon  = json_decode($order->coupon);
@endphp

@extends('vendor.layouts.master')
@section('title')
    {{ $settings->site_name }} - Sipariş Detay
@endsection
@section('content')
    <!--=============================
                                    DASHBOARD START
                                  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Sipariş Detayı</h3>
                        <div class="wsus__dashboard_profile">
                            <!--============================
                                INVOICE PAGE START
                            ==============================-->
                            <section id="invoice_print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Fatura</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }},{{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>shipping information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }},{{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h5>Fatura ID: #{{ $order->invocie_id }}</h5>
                                                            <h6>Sipariş Durumu:
                                                                {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                                            </h6>
                                                            <p>Ödeme Durumu: {{ $order->payment_status }}</p>
                                                            <p>Belge ID: {{ $order->transaction->transaction_id }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                Ürün
                                                            </th>
                                                            <th class="amount">
                                                                Mağaza
                                                            </th>
                                                            <th class="amount">
                                                                Tutar
                                                            </th>

                                                            <th class="quentity">
                                                                Adet
                                                            </th>
                                                            <th class="total">
                                                                Toplam
                                                            </th>
                                                        </tr>
                                                        @foreach ($order->orderProducts as $product)
                                                            @php
                                                                $variants = json_decode($product->variants);
                                                            @endphp
                                                            <tr>
                                                                <td class="name">
                                                                    <p>{{ $product->product_name }}</p>
                                                                    @foreach ($variants as $key => $variant)
                                                                        <span>{{ $key }} :
                                                                            {{ $variant->name }}
                                                                            ({{ $settings->currency_icon }}{{ $variant->price }})
                                                                        </span>
                                                                    @endforeach

                                                                </td>
                                                                <td class="amount">
                                                                    {{ $product->vendor->shop_name }}
                                                                </td>
                                                                <td class="amount">
                                                                    {{ $settings->currency_icon }}{{ $product->unit_price }}
                                                                </td>

                                                                <td class="quentity">
                                                                    {{ $product->qty }}
                                                                </td>
                                                                <td class="total">
                                                                    {{ $settings->currency_icon }}{{ $product->unit_price * $product->qty }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">
                                            <p><span>Ara toplam:</span>
                                                {{ $settings->currency_icon }}{{ $order->sub_total }} </p>
                                                <p><span>Kargo Ücreti(+):</span>
                                                    {{ $settings->currency_icon }}{{ $shipping->cost}} </p>
                                                    <p><span>Kupon(-):</span>
                                                        {{ $settings->currency_icon }}{{ $coupon->discount }} </p>
                                                        <p><span>Toplam Ücret:</span>
                                                            {{ $settings->currency_icon }}{{ $order->amount }} </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="col-md-8">
                                <div class="mt-5 float-end">
                                    <button class="btn btn-warning print_invoice">Yazdır</button>
                                </div>
                            </div>
                            <!--============================
                                INVOICE PAGE END
                            ==============================-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================-->
    DASHBOARD START
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('.print_invoice').on('click', function() {

                let printBody = $('.wsus__invoice_area');
                let originalContents = $('body').html();
                $('body').html(printBody.html());
                window.print();
                $('body').html(originalContents);

            })

        });
    </script>
@endpush
