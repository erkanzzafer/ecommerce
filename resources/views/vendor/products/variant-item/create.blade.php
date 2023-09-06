@extends('vendor.layouts.master')
@section('title')
{{ $settings->site_name }} - Product Variant Item
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

                    <a href="{{ route('vendor.products-variant.showTable',$product->id) }}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Geri Dön</a>

                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Ürün Varyant Öge Ekle {{ $product->name }} - {{ $variant->name }}</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card-body">
                                    <form action="{{ route('vendor.products-variant-item.store')}}" method="post">
                                        @csrf
                                        <div class="form-group wsus__input">
                                            <label >Varyant İsim</label>
                                            <input type="text" class="form-control" name="" value="{{ $variant->name}}" readonly>
                                        </div>

                                        <div class="form-group ">
                                            <input type="hidden" class="form-control" name="variant_id" value="{{ $variant->id}}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="product_id" value="{{ $product->id}}" readonly>
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label >Oge İsim</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('item_name ') }}">
                                        </div>
                                        <div class="form-group wsus__input">
                                            <label >Ücret <code>(Ücretsiz için 0 giriniz)</code></label>
                                            <input type="text" class="form-control" name="price" value="{{ old('price ') }}">
                                        </div>



                                        <div class="form-group wsus__input">
                                            <label for="inputState">Varsayılan</label>
                                            <select id="inputState" class="form-control" name="is_default" >
                                                <option value="1" selected>Evet</option>
                                                <option value="0">Hayır</option>
                                            </select>
                                        </div>

                                        <div class="form-group wsus__input">
                                            <label for="inputState">Durum</label>
                                            <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                                                <option value="1" selected>Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Kaydet</button>
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
