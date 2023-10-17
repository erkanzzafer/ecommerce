<div class="tab-pane fade show" id="list-cart" role="tabpanel" aria-labelledby="list-cart-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.cart-page-banner') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h5>Resim 1</h5>
                <div class="form-group">
                    <label for="">Durum</label>
                    <label class="custom-switch mt-12">
                        <input type="checkbox" {{ @$cartpage_banner_section->cart_banner_one->status==1 ? 'checked' : '' }} name="status_one" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset(@$cartpage_banner_section->cart_banner_one->banner_image_one) }}" width="150px" alt="">
                </div>
                <div class="form-group">
                    <label for="">Banner Resim</label>
                    <input type="file" class="form-control" name="banner_image_one" value="">
                    <input type="hidden" value="{{ @$cartpage_banner_section->cart_banner_one->banner_image_one }}" name="cart_banner_old_image_one" id="">
                </div>
                <div class="form-group">
                    <label for="">Banner Link</label>
                    <input type="text" class="form-control" name="banner_url_one" value="{{ @$cartpage_banner_section->cart_banner_one->banner_url }}">
                </div>

                <hr>
                <h5>Resim 2</h5>
                <div class="form-group">
                    <label for="">Durum</label>
                    <label class="custom-switch mt-12">
                        <input type="checkbox" {{ @$cartpage_banner_section->cart_banner_two->status==1 ? 'checked' : '' }} name="status_two" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset(@$cartpage_banner_section->cart_banner_two->banner_image_two) }}" width="150px" alt="">
                </div>
                <div class="form-group">
                    <label for="">Banner Resim</label>
                    <input type="file" class="form-control" name="banner_image_two" value="">
                    <input type="hidden" value="{{ @$cartpage_banner_section->cart_banner_two->banner_image_two }}" name="cart_banner_old_image_two" id="">
                </div>
                <div class="form-group">
                    <label for="">Banner Link</label>
                    <input type="text" class="form-control" name="banner_url_two" value="{{ @$cartpage_banner_section->cart_banner_two->banner_url }}">
                </div>




                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>

</div>
