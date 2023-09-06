@extends('vendor.layouts.master')
@section('title')
{{ $settings->site_name }} - Product
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
                        <h3><i class="far fa-user"></i> Ürün Ekle</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card-body">
                                    <form action="{{ route('vendor.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="form-group wsus__input">
                                            <label for="">Önizleme</label>
                                            <br>
                                            <img src="{{ asset( $product->thumb_image) }}" width="200" alt="">
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="">Resim</label>
                                            <input type="file" class="form-control" name="image" >
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="">İsim</label>
                                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group wsus__input">
                                                    <label for="inputState">Kategori</label>
                                                    <select id="inputState" class="form-control main-category" name="category" >
                                                        <option value="" selected>Seçiniz</option>
                                                        @foreach ($categories as $category )
                                                             <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }} >{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group wsus__input">
                                                    <label for="inputState">Alt Kategori</label>
                                                    <select id="inputState" class="form-control subcategory" name="sub_category">
                                                        <option value="" selected>Seçiniz</option>
                                                        @foreach ($subcategories as $subcategory )
                                                             <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->sub_category_id ? 'selected' : '' }} >{{ $subcategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group wsus__input">
                                                    <label for="inputState">Çocuk Kategori</label>
                                                    <select id="inputState" class="form-control child_category" name="child_category" >
                                                        <option value="" selected>Seçiniz</option>
                                                        @foreach ($childcategories as $childcategory )
                                                        <option value="{{ $childcategory->id }}" {{ $childcategory->id == $product->child_category_id ? 'selected' : '' }} >{{ $childcategory->name }}</option>
                                                   @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group wsus__input">
                                                <label for="inputState">Marka</label>
                                                <select id="inputState" class="form-control" name="brand" >
                                                    <option value="" selected>Seçiniz</option>
                                                    @foreach ($brands as $brand )
                                                        <option value=" {{ $brand->id }}" {{ $brand->id== $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        <div class="form-group wsus__input">
                                                <label for="">SKU</label>
                                                <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="">Fiyat</label>
                                            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                        </div>


                                        <div class="form-group wsus__input">
                                            <label for="">Fiyat Teklifi</label>
                                            <input type="text" class="form-control" name="offer_price" value="{{ $product->offer_price  }}">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group wsus__input">
                                                    <label for="">Teklif Başlangıç Tarihi</label>
                                                    <input type="date" class="form-control" name="offer_start_date" value="{{ $product->offer_start_date}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group wsus__input">
                                                    <label for="">Teklif Bitiş Tarihi</label>
                                                    <input type="date" class="form-control" name="offer_end_date" value="{{ $product->offer_end_date }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group wsus__input">
                                            <label for="">Stok Miktarı</label>
                                            <input type="text"  min="0" class="form-control" name="qty" value="{{ $product->qty }}">
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="">Video Linki</label>
                                            <input type="text"   class="form-control" name="video_link" value="{{ $product->video_link }}">
                                        </div>
                                        <div class="form-group wsus__input">
                                            <label for="">Kısa Açıklama</label>
                                            <textarea   class="form-control" name="short_description" >{!! $product->short_description !!}</textarea>
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="">Uzun Açıklama</label>
                                            <textarea   class="form-control summernote" name="long_description" >{!! $product->long_description !!}</textarea>
                                        </div>


                                        <div class="form-group wsus__input">
                                            <label for="inputState">Ürün Tip</label>
                                                 <select id="inputState" class="form-control" name="product_type">
                                                    <option value="0" >Seçiniz</option>
                                                    <option value="new_arrival"  {{ $product->product_type='new_arrival' ? 'selected' : '' }} >New Arrival</option>
                                                    <option value="featured" {{ $product->product_type='featured' ? 'selected' : '' }}>Featured</option>
                                                    <option value="top_product" {{ $product->product_type='top_product' ? 'selected' : '' }}>Top Product</option>
                                                    <option value="best_product" {{ $product->product_type='best_product' ? 'selected' : '' }}>Best Product</option>
                                                </select>
                                        </div>




                                        <div class="form-group wsus__input">
                                            <label for="">SEO Başlık</label>
                                            <input type="text"   class="form-control" name="seo_title" value="{{ $product->seo_title }}">
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="">SEO Açıklama</label>
                                            <input type="text"   class="form-control" name="seo_description" value="{!! $product->seo_description !!}">
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="inputState">Durum</label>
                                            <select id="inputState" class="form-control" name="status">
                                                <option value="1" {{ $product->status==1 ? 'selected' : '' }} >Aktif</option>
                                                <option value="0" {{ $product->status==0 ? 'selected' : '' }}>Pasif</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                    </form>
                                </div>
                            </div>
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
    $(document).ready(function(){
        $('body').on('change','.main-category',function(e){
            let id=$(this).val();
            $.ajax({
                method:'get',
                url:"{{ route('vendor.get-subcategories') }}",
                data:{
                    id:id
                },
                success:function(data){
                    $('.subcategory').empty();
                    $('.subcategory').append(`<option value="">Seçiniz</option>`);
                   $.each(data,function(i,item){
                        $('.subcategory').append(`<option value="${item.id}">${item.name}</option>`)
                   })
                },
                error:function(xhr,status,error){
                    toastr.error(error);
                }
            })
        })
    });
</script>

<script>
    $(document).ready(function(){
        $('body').on('change','.subcategory',function(e){
            let id=$(this).val();
            $.ajax({
                method:'get',
                url:"{{ route('vendor.get-childcategories') }}",
                data:{
                    id:id
                },
                success:function(data){
                    $('.child_category').empty();
                   $.each(data,function(i,item){
                        $('.child_category').append(`<option value="${item.id}">${item.name}</option>`)
                   })
                },
                error:function(xhr,status,error){
                    toastr.error(error);
                }
            })
        })
    });
</script>
@endpush
