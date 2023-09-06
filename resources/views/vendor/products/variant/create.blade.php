@extends('vendor.layouts.master')
@section('title')
{{ $settings->site_name }} - Product Variant
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
                    <a href="{{ route('vendor.products-variant.showTable',request()->product) }}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Geri Dön</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Ürün Varyant Ekle</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card-body">
                                    <form action="{{ route('vendor.products-variant.store')}}" method="post">
                                        @csrf
                                        <div class="form-group wsus__input">
                                            <label >Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name ') }}">
                                        </div>
                                        <div class="form-group wsus__input">
                                            <label for="inputState">Durum</label>
                                            <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                                                <option value="1" selected>Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ request()->product }}">
                                        <button type="submit" class="btn btn-primary mt-4">Kaydet</button>
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
