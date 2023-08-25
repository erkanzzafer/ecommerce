@extends('vendor.layouts.master')
@section('content')
    <!--=============================
            DASHBOARD START
          ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">

                    <a href="{{ route('vendor.products-variant.showTable',$variant->id) }}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Geri Dön</a>

                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Ürün Varyant Öge Ekle </h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card-body">
                                    <form action="{{ route('vendor.products-variant-item.update',$variant->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label >Varyant Öge Güncelle</label>
                                            <input type="text" class="form-control" name="" value="{{ $variant->productVariant->name }}" readonly>
                                        </div>


                                        <div class="form-group">
                                            <label >Oge İsim</label>
                                            <input type="text" class="form-control" name="name" value="{{ $variant->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label >Ücret <code>(Ücretsiz için 0 giriniz)</code></label>
                                            <input type="text" class="form-control" name="price" value="{{ $variant->price }}">
                                        </div>



                                        <div class="form-group">
                                            <label for="inputState">Varsayılan</label>
                                            <select id="inputState" class="form-control" name="is_default" >
                                                <option value="1" {{ $variant->is_default == 1  ? 'selected' : '' }}>Evet</option>
                                                <option value="0" {{ $variant->is_default == 0  ? 'selected' : '' }}>Hayır</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputState">Durum</label>
                                            <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                                                <option value="1" {{ $variant->status == 1 ? 'selected'  : '' }}>Aktif</option>
                                                <option value="0" {{ $variant->status == 0 ? 'selected'  : '' }}>Pasif</option>
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
