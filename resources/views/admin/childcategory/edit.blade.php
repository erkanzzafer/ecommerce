@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Çocuk Kategori Düzenle</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Çocuk Kategori Düzenle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.childcategory.update',$childCategory->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="inputState">Kategori</label>
                        <select id="inputState" class="form-control main-category" name="category">
                            <option selected>Seçiniz</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id==$childCategory->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Alt Kategori</label>
                        <select id="inputState" class="form-control subcategory" name="subcategory" >
                            <option selected>Seçiniz</option>
                            @foreach ($subcategories as $subcategory )
                            <option value="{{ $subcategory->id }}" {{ $subcategory->id==$childCategory->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label >Name</label>
                        <input type="text" class="form-control" name="name" value={{ $childCategory->name }}>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" >
                            <option value="1" {{ $childCategory->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $childCategory->status == 0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </form>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change','.main-category',function(e){
            let id=$(this).val();
            $.ajax({
                method:'get',
                url:"{{ route('admin.get-subcategories') }}",
                data:{
                    id:id
                },
                success:function(data){
                    $('.subcategory').empty();
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
@endpush
