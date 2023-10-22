<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">

                            <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                            <button data-filter=".featured">Featured</button>
                            <button data-filter=".top_product">Top Product</button>
                            <button data-filter=".best_product">Best Product</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeBaseProduct as $key => $products)
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-sm-6 col-lg-4 {{ $key }}">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($product->product_type) }}</span>
                                @if (checkDiscount($product))
                                    <span
                                        class="wsus__minus">-{{ caculateDiscount($product->price, $product->offer_price) }}%</span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1" />
                                    <img src="
                           @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                           @else
                               {{ asset($product->thumb_image) }} @endif
                            "
                                        alt="product" class="img-fluid w-100 img_2" />
                                    {{--  <img src="images/pro3_3.jpg" alt="product" class="img-fluid w-100 img_2" /> --}}
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#product-{{ $product->id }}"><i class="far fa-eye"></i></a>
                                    </li>
                                    <li><a href="javascript:;" class="addToWishlist" data-id="{{ $product->id }}"><i
                                                class="far fa-heart"></i></a></li>
                                    {{-- <li><ahref="#"><iclass="farfa-random"></i></a> --}}
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category"
                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->category->name }}
                                    </a>
                                    <p class="wsus__pro_rating">
                                        @php
                                            $avgRating = $product->reviews()->avg('rating');
                                            $fullRating = round($avgRating);
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullRating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span>({{ count($product->reviews) }} Yorum)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 20) }}</a>
                                    @if (checkDiscount($product))
                                        <p class="wsus__price">
                                            {{ $settings->currency_icon }}{{ $product->offer_price }}
                                            <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->price }}</p>
                                    @endif
                                    <form class="shopping-cart-form">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->variant as $variant)
                                            <select class="d-none" name="variants_items[]">
                                                @foreach ($variant->productVariantItems as $variantItem)
                                                    <option value="{{ $variantItem->id }}"
                                                        {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $variantItem->name }} ({{ $variantItem->price }})</option>
                                                @endforeach
                                            </select>
                                        @endforeach
                                        <input name="qty" type="hidden" value="1" />
                                        <button type="submit" class="add_cart" href="#">Sepete Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        @if ($homepage_section_banner_three->banner_one->status == 1)
                            <div class="wsus__single_banner_content banner_1">
                                <a href="{{ $homepage_section_banner_three->banner_one->banner_url }}">
                                    <img class="img-fluid"
                                        src="{{ @asset($homepage_section_banner_three->banner_one->banner_one_image) }}"
                                        alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if ($homepage_section_banner_three->banner_two->status == 1)
                                    <div class="wsus__single_banner_content single_banner_2">
                                        <a href="{{ $homepage_section_banner_three->banner_two->banner_url }}">
                                            <img class="img-fluid"
                                                src="{{ @asset($homepage_section_banner_three->banner_two->banner_two_image) }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                @if ($homepage_section_banner_three->banner_three->status == 1)
                                    <div class="wsus__single_banner_content">
                                        <a href="{{ $homepage_section_banner_three->banner_three->banner_url }}">
                                            <img class="img-fluid"
                                                src="{{ @asset($homepage_section_banner_three->banner_three->banner_three_image) }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
</section>

<!--==========================
          PRODUCT MODAL VIEW START
        ===========================-->
@foreach ($typeBaseProduct as $key => $products)
    @foreach ($products as $product)
        <section class="product_popup_modal">
            <div class="modal fade" id="product-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="wsus__quick_view_img">
                                        @if (!empty($product->video_link))
                                            <a class="venobox wsus__pro_det_video" data-autoplay="true"
                                                data-vbtype="video" href="https://youtu.be/7m16dFI1AF8">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif
                                        <div class="row modal_slider">
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>

                                            @foreach ($product->productImageGalleries as $image)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($image->image) }}" alt="product"
                                                            class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <a class="title" href="#">{{ limitText($product->name, 20) }}</a>
                                        <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)
                                        </p>
                                        @if (checkDiscount($product))
                                            <h4>{{ $settings->currency_icon }}{{ $product->offer_price }}
                                                <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                            </h4>
                                        @else
                                            <h4>{{ $settings->currency_icon }}{{ $product->price }} </h4>
                                        @endif
                                        <p class="review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>20 review</span>
                                        </p>
                                        <p class="description">{!! $product->short_description !!}</p>

                                        <form class="shopping-cart-form">
                                            <div class="wsus__selectbox">
                                                <div class="row">
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->id }}">
                                                    @foreach ($product->variant as $variant)
                                                        @if ($variant->status != 0)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5>{{ $variant->name }}</h5>
                                                                <select class="select_2" name="variants_items[]">
                                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                                        @if ($variantItem->status != 0)
                                                                            <option value="{{ $variantItem->id }}"
                                                                                {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $variantItem->name }}
                                                                                ({{ $variantItem->price }})
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="wsus__quentity">
                                                <h5>quentity :</h5>
                                                <div class="select_number">
                                                    <input class="number_area" name="qty" type="text"
                                                        min="1" max="100" value="1" />
                                                </div>
                                            </div>

                                            <ul class="wsus__button_area">
                                                <li><button type="submit" class="add_cart" href="#">Sepete
                                                        Ekle</button></li>
                                                <li><a class="buy_now" href="#">Satın Al</a></li>
                                                <li><a href="javascript:;" class="addToWishlist"
                                                        data-id="{{ $product->id }}"><i
                                                            class="fal fa-heart"></i></a></li>
                                                {{-- <li><ahref="#"><iclass="farfa-random"></i></a></li> --}}
                                            </ul>
                                        </form>



                                        <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endforeach

<!--==========================
                  PRODUCT MODAL VIEW END
                ===========================-->
