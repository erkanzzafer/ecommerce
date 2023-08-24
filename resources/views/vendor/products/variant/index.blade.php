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
                    <a href="{{ route('vendor.products.index') }}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Geri Dön</a>

                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Ürün Varyant</h3>


                        <div class="create_button">
                            <a href="{{ route('vendor.products-variant.create',['product'=> $products->id]) }}" class="btn btn-primary"><i class="fa fa-plus"></i>Yeni Varyant Ekle</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card-body">
                                    {{ $dataTable->table() }}
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
{{ $dataTable->scripts(attributes:['type'=>'module']) }}
<script>
    $(document).ready(function(){
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('body').on('click','.change-status',function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url:"{{ route('vendor.product-variant.change-status') }}",
                    method:'put',
                    data:{
                        _token: csrfToken,
                        status:isChecked,
                        id:id
                    },
                    success:function(data){
                        toastr.success(data.message);
                    },
                    error:function(xhr,status,error){

                        toastr.error(error);
                    }
                })
        })
    });

</script>
@endpush
