@extends('frontend.dashboard.layouts.master')
@section('title')
    {{ $settings->site_name }} - Mağaza Aç
@endsection
@section('content')
    <!--=============================
                        DASHBOARD START
                      ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Mağaza Aç</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                            </div>
                        </div>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('user.vendor-request.create') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="file" name="shop_image" placeholder="Mağaza Banner İmage">
                                    </div>
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="text" name="shop_name" placeholder="Mağaza İsmi">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                <input type="text" name="shop_email" placeholder="Mağaza Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                <input type="text" name="shop_phone" placeholder="Mağaza Telefon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="text" name="shop_address" placeholder="Mağaza Adres">
                                    </div>

                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <textarea name="about" placeholder="Hakkında"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gönder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
