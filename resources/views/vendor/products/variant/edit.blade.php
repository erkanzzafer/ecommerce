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
                    <a href="{{ route('vendor.products-variant.showTable',$product->product_id) }}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Geri Dön</a>

                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Ürün Varyant Güncelle</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card-body">
                                    <form action="{{ route('vendor.products-variant.update',$product->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group wsus__input">
                                            <label >Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                        </div>
                                        <div class="form-group wsus__input">
                                            <label for="inputState">Durum</label>
                                            <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                                                <option value="1"  {{ $product->status == 1 ? 'selected': '' }}>Aktif</option>
                                                <option value="0" {{ $product->status == 0 ? 'selected': '' }}>Pasif</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-4">Güncelle</button>
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
