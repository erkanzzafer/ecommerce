
@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Processed Siparişler</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Tüm Processed Siparişler</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Yeni Ekle</a>
                </div>
              </div>
              <div class="card-body">
                {{ $dataTable->table() }}
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

@endsection
@push('scripts')
{{ $dataTable->scripts(attributes:['type'=>'module']) }}
<script>
    $(document).ready(function(){

        $('body').on('click','.change-status',function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url:"{{ route('admin.product.change-status') }}",
                    method:'put',
                    data:{
                        status:isChecked,
                        id:id
                    },
                    success:function(data){
                        toastr.success(data.message);
                    },
                    error:function(xhr,status,error){
                        console.log(error);
                    }
                })
        })
    });

</script>
@endpush
