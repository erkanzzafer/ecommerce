@extends('admin.layouts.master')
@section('content')
<!-- Main Content -->

<section class="section">
    <div class="section-header">
        <h1>Genel Ayarlar</h1>

    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>JavaScript Behavior</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="list-group" id="list-tab" role="tablist">

                                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Popüler Kategori Alanı</a>
                                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Ürün Slayder 1</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Ürün Slayder 2</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-slider-three" role="tab">Ürün Slayder 3</a>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="tab-content" id="nav-tabContent">

                                   @include('admin.home-page-setting.sections.popular-category-section')

                                   @include('admin.home-page-setting.sections.product-slider-section-one')

                                   @include('admin.home-page-setting.sections.product-slider-section-two')

                                   @include('admin.home-page-setting.sections.product-slider-section-three')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
@push('scripts')

@endpush
