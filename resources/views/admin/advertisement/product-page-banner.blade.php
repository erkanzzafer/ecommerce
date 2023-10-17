<div class="tab-pane fade show" id="list-product" role="tabpanel" aria-labelledby="list-product-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.product-page-banner') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Durum</label>
                    <label class="custom-switch mt-12">
                        <input type="checkbox" {{ @$productpage_banner_section->product_banner->status==1 ? 'checked' : '' }} name="status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset(@$productpage_banner_section->product_banner->banner_product_image) }}" width="150px" alt="">
                </div>
                <div class="form-group">
                    <label for="">Banner Resim</label>
                    <input type="file" class="form-control" name="banner_image" value="">
                    <input type="hidden" value="{{ @$productpage_banner_section->product_banner->banner_product_image }}" name="product_banner_old_image" id="">
                </div>

                <div class="form-group">
                    <label for="">Banner Link</label>
                    <input type="text" class="form-control" name="banner_url" value="{{ @$productpage_banner_section->product_banner->banner_url }}">
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
