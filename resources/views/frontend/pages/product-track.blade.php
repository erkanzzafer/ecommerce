@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} - Ürün Takibi
@endsection
@section('content')
    <!--============================
                                                        BREADCRUMB START
                                                    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>order tracking</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">order tracking</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                        BREADCRUMB END
                                                    ==============================-->


    <!--============================
                                                        TRACKING ORDER START
                                                    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form action="{{ route('product-tracking.index') }}" method="get" class="tack_form">

                            <h4 class="text-center">Sipariş Takibi</h4>
                            <p class="text-center">tracking your order status</p>
                            <div class="wsus__track_input">
                                <label class="d-block mb-2">Sipariş Numarası</label>
                                <input type="text" placeholder="#H25-21578455" name="tracker"
                                    value="{{ @$order->invocie_id }}">
                            </div>
                            <button type="submit" class="common_btn">Görüntüle</button>
                        </form>
                    </div>
                </div>

                @if (isset($order))
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="wsus__track_header">
                                <div class="wsus__track_header_text">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Sipariş Oluşturulma Tarihi</h5>
                                                <p>{{ $order->created_at->isoFormat('D MMMM YYYY') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Alıcı</h5>
                                                <p>{{ $order->user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Durum:</h5>
                                                <p>{{ $order->order_status }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single border_none">
                                                <h5>tracking:</h5>
                                                <p>{{ $order->invocie_id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <ul class="progtrckr" data-progtrckr-steps="4">
                                <li class="progtrckr_done icon_one check_mark">Order pending</li>
                                @if ($order->order_status == 'canceled')
                                    <li class="icon_four red_mark">Sipariş İptal Edildi</li>
                                @else
                                    <li
                                        class="progtrckr_done icon_two
                                    @if (
                                        $order->order_status == 'processed_and_ready_to_ship' ||
                                            $order->order_status == 'dropped_off' ||
                                            $order->order_status == 'shipped' ||
                                            $order->order_status == 'out_for_delivery' ||
                                            $order->order_status == 'delivered') check_mark @endif
                                    ">
                                        order Processing</li>
                                    <li
                                        class="icon_three
                                    @if ($order->order_status == 'out_for_delivery' || $order->order_status == 'delivered') check_mark @endif
                                    ">
                                        on the way</li>
                                    <li
                                        class="icon_four check_mark
                                    @if ($order->order_status == 'delivered') check_mark @endif">
                                        Delivered</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-xl-12">
                            <a href="{{ url('') }}" class="common_btn"><i class="fas fa-chevron-left"></i> Anasayfaya Dön</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--============================
                                                        TRACKING ORDER END
                                                    ==============================-->
@endsection
@push('scripts')
@endpush
