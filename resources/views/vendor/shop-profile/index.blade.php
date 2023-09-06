@extends('vendor.layouts.master')
@section('title')
{{ $settings->site_name }} - Shop Profile
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
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>Bilgileri Güncelle</h4>
                                <form action="{{ route('vendor.shop-profile.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group wsus__input">
                                        <label for="">Önizleme</label>
                                        <img width="200" src="" alt="">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="">Banner</label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>


                                    <div class="form-group wsus__input">
                                        <label for="">Dükkan İsmi</label>
                                        <input type="text" class="form-control" name="shop_name"
                                            value="{{ $profile->shop_name }}">
                                    </div>



                                    <div class="form-group wsus__input">
                                        <label for="">Telefon</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $profile->phone }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $profile->email }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label for="">Adres</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $profile->address }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="">Açıklama</label>
                                        <textarea class="summernote" name="description">{{ $profile->description }}</textarea>
                                    </div>


                                    <div class="form-group wsus__input">
                                        <label for="">Facebook Link</label>
                                        <input type="text" class="form-control" name="fb_link"
                                            value="{{ $profile->fb_link }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="">Twitter Link</label>
                                        <input type="text" class="form-control" name="tw_link"
                                            value="{{ $profile->tw_link }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="">İnstagram Link</label>
                                        <input type="text" class="form-control" name="insta_link"
                                            value="{{ $profile->insta_link }}">
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
        </div>
    </section>
    <!--=============================
            DASHBOARD START
@endsection
