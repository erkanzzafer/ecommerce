@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp
@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Siparişler</h1>

        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2></h2>
                                <div class="invoice-number">Order #{{ $order->invocie_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <b>İsim:</b> {{ $address->name }}<br>
                                        <b>Email:</b> {{ $address->email }}<br>
                                        <b>Telefon:</b> {{ $address->phone }}<br>
                                        <b>Adres:</b> {{ $address->address }}<br>
                                        {{ $address->city }},{{ $address->state }},{{ $address->zip }}<br>
                                        {{ $address->country }}<br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <b>İsim:</b> {{ $address->name }}<br>
                                        <b>Email:</b> {{ $address->email }}<br>
                                        <b>Telefon:</b> {{ $address->phone }}<br>
                                        <b>Adres:</b> {{ $address->address }}<br>
                                        {{ $address->city }},{{ $address->state }},{{ $address->zip }}<br>
                                        {{ $address->country }}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Ödeme Bilgileri:</strong><br>
                                        <b>Yöntem:</b>{{ $order->payment_method }}<br>
                                        <b>Transaction Id:</b>{{ $order->transaction->transaction_id }}<br>
                                        <b>Durum:</b> {{ $order->payment_status == 1 ? 'Tamamlandı' : 'Beklemede' }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Sipariş Tarihi:</strong><br>
                                        {{ $order->created_at->isoFormat('D MMMM YYYY') }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th class="text-center">Ürün</th>
                                        <th class="text-center">Varyant</th>
                                        <th class="text-center">Satıcı İsmi</th>
                                        <th class="text-center">Ücret</th>
                                        <th class="text-center">Adet</th>
                                        <th class="text-right">Toplam</th>
                                    </tr>
                                    @foreach ($order->orderProducts as $product)
                                        @php

                                            $variants = json_decode($product->variants, true);
                                            // dd($variants);
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ ++$loop->index }}</td>
                                            @if (isset($product->product->slug))
                                                <td class="text-center"><a
                                                        href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                                </td>
                                            @else
                                                <td class="text-center">{{ $product->product_name }}</td>
                                            @endif
                                            <td class="text-center">
                                                @forelse ($variants as $key => $value)
                                                    <br>{{ $key }} : {{ $value['name'] }}
                                                    ({{ $settings->currency_icon . $value['price'] }})
                                                @empty
                                                    <b>(-)</b>
                                                @endforelse
                                            </td>
                                            <td class="text-center">{{ $product->vendor->shop_name }}</td>
                                            <td class="text-center">
                                                {{ $settings->currency_icon }}{{ $product->unit_price }}</td>
                                            <td class="text-center">{{ $product->qty }}</td>
                                            <td class="text-right">
                                                {{ $settings->currency_icon }}{{ ($product->unit_price + $product->variant_total) * $product->qty }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Ödeme Durumu</label>
                                            <select name="" class="form-control" data-id={{ $order->id }}
                                                id="payment_status">
                                                <option value="0"
                                                    {{ $order->payment_status == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1"
                                                    {{ $order->payment_status == 1 ? 'selected' : '' }}>Completed</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sipariş Durumu</label>
                                            <select name="order_status" class="form-control" data-id={{ $order->id }}
                                                id="order_status">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                    <option {{ $order->order_status == $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $orderStatus['status'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Ara Toplam</div>
                                        <div class="invoice-detail-value"> {{ $settings->currency_icon . $order->sub_total }}
                                        </div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Kargo(+)</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon . @$shipping->cost }}
                                        </div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Kupon(-)</div>
                                        <div class="invoice-detail-value">
                                            {{ $settings->currency_icon }}{{ @$coupon->discount ?: 0 }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $settings->currency_icon }}{{ $order->amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order_status').on('change', function() {
                let status = $(this).val();
                //alert(status)

                let id = $(this).data('id');
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {

                    }

                })
            })

            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {

                    }

                })
            })

            $('.print_invoice').on('click', function() {

                let printBody = $('.invoice-print');

                let originalContents = $('body').html();
                $('body').html(printBody.html());

                window.print();

                $('body').html(originalContents);

            })

        })
    </script>
@endpush
