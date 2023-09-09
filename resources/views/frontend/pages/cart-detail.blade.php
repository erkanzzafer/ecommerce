@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} - Ürün Detayı
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
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
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
                                                CART VIEW PAGE START
                                            ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            Ürün Detay
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Birim Ücret
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Toplam
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{!! $item->name !!}</p>
                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{ $key }} : {{ $variant['name'] }}
                                                        ({{ $settings->currency_icon . $variant['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="wsus__pro_tk">
                                                <h6>{{ $settings->currency_icon . $item->price }}</h6>
                                            </td>
                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $settings->currency_icon . ($item->price + $item->options->variants_total) * $item->qty }}
                                                </h6>
                                            </td>
                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper ">
                                                    <button class="btn btn-danger product-decrement">-</button>
                                                    <input class="product-qty" data-rowid={{ $item->rowId }} type="text"
                                                        min="1" max="100" value="{{ $item->qty }}"
                                                        readonly />
                                                    <button class="btn btn-success product-increment">+</button>
                                                </div>
                                            </td>
                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart.remove-product', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($cartItems) == 0)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_icon" rowspan="2" style="width:100%">
                                                Sepette ürün bulunmuyor!
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub_total">{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                  CART VIEW PAGE END
                                            ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.product-decrement').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                if (quantity < 1) {
                    quantity = 1;
                }
                input.val(quantity);
                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'post',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total
                            $(productId).text(totalAmount);
                            renderCartSubTotal();
                            toastr.success(data.message)

                        }
                    },
                    error: function(data) {

                    }
                })
            })


            $('.product-increment').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);
                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'post',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total
                            $(productId).text(totalAmount);
                            renderCartSubTotal();
                            toastr.success(data.message)

                        } else if (data.status == 'error') {
                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            //clear - cart
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();
                //swal
                Swal.fire({
                    title: 'Sepeti boşaltmak istediğinize emin misiniz?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet',
                    cancelButtonText: 'Hayır'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear.cart') }}",
                            success: function(data) {
                                if (data.status == 'success') {
                                    window.location.reload();
                                    toastr.success(data.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                swal.fire(
                                    'cant Delete',
                                    error,
                                    'error'
                                )
                            }
                        })
                    }
                });
                //swal
            })


            function renderCartSubTotal() {
                $.ajax({
                    method: 'get',
                    url: "{{ route('cart.sidebar-product-total') }}",
                    success: function(data) {
                        $('#sub_total').text("{{ $settings->currency_icon }}"+data);
                    },
                    error: function(data) {}
                })
            }



        });
    </script>
@endpush
