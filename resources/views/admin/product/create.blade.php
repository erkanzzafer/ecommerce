@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Ürün Oluştur</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Slider Oluştur</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Resim</label>
                        <input type="file" class="form-control" name="image" >
                    </div>

                    <div class="form-group">
                        <label for="">İsim</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Kategori</label>
                                <select id="inputState" class="form-control main-category" name="category" >
                                    <option value="" selected>Seçiniz</option>
                                    @foreach ($categories as $category )
                                         <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Alt Kategori</label>
                                <select id="inputState" class="form-control subcategory" name="sub_category">
                                    <option value="" selected>Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Çocuk Kategori</label>
                                <select id="inputState" class="form-control child_category" name="child_category" >
                                    <option value="" selected>Seçiniz</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="inputState">Marka</label>
                            <select id="inputState" class="form-control" name="brand" >
                                <option value="" selected>Seçiniz</option>
                                @foreach ($brands as $brand )
                                    <option value=" {{ $brand->id }}" >{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    <div class="form-group">
                            <label for="">SKU</label>
                            <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Fiyat</label>
                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                    </div>


                    <div class="form-group">
                        <label for="">Fiyat Teklifi</label>
                        <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Teklif Başlangıç Tarihi</label>
                                <input type="date" class="form-control" name="offer_start_date" value="{{ old('offer_start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Teklif Bitiş Tarihi</label>
                                <input type="date" class="form-control" name="offer_end_date" value="{{ old('offer_end_date') }}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">Stok Miktarı</label>
                        <input type="text"  min="0" class="form-control" name="qty" value="{{ old('qty') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Video Linki</label>
                        <input type="text"   class="form-control" name="video_link" value="{{ old('video_link') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Kısa Açıklama</label>
                        <textarea   class="form-control" name="short_description" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Uzun Açıklama</label>
                        <textarea   class="form-control summernote" name="long_description" ></textarea>
                    </div>


                    <div class="form-group">
                        <label for="inputState">Ürün Tip</label>
                             <select id="inputState" class="form-control" name="product_type">
                                <option value="0" selected>Seçiniz</option>
                                <option value="new_arrival" selected>New Arrival</option>
                                <option value="featured" selected>Featured</option>
                                <option value="top_product" selected>Top Product</option>
                                <option value="best_product" selected>Best Product</option>
                            </select>
                    </div>




                    <div class="form-group">
                        <label for="">SEO Başlık</label>
                        <input type="text"   class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                    </div>

                    <div class="form-group">
                        <label for="">SEO Açıklama</label>
                        <input type="text"   class="form-control" name="seo_description" value="{{ old('seo_description') }}">
                    </div>

                    <div class="form-group">
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
                    $('.subcategory').append(`<option value="">Seçiniz</option>`);
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

<script>
    $(document).ready(function(){
        $('body').on('change','.subcategory',function(e){
            let id=$(this).val();
            $.ajax({
                method:'get',
                url:"{{ route('admin.get-childcategories') }}",
                data:{
                    id:id
                },
                success:function(data){
                    $('.child_category').empty();
                   $.each(data,function(i,item){
                        $('.child_category').append(`<option value="${item.id}">${item.name}</option>`)
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


