<div class="tab-pane fade show" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.homepage-banner-section-one') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h5>Resim 1</h5>
                <div class="form-group">
                    <label for="">Durum</label>
                    <label class="custom-switch mt-12">
                        <input type="checkbox" {{ $homepage_section_banner_one->banner_one->status==1 ? 'checked' : '' }} name="banner_one_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset($homepage_section_banner_one->banner_one->banner_image) }}" width="150px" alt="">
                </div>
                <div class="form-group">
                    <label for="">Banner Resim</label>
                    <input type="file" class="form-control" name="banner_one_image" value="">
                    <input type="hidden" value="{{ $homepage_section_banner_one->banner_one->banner_image }}" name="banner_one_old_image" id="">
                </div>

                <div class="form-group">
                    <label for="">Banner Link</label>
                    <input type="text" class="form-control" name="banner_one_url" value="{{ $homepage_section_banner_one->banner_one->banner_url }}">
                </div>

                <hr>
                <h5>Resim 2</h5>
                <div class="form-group">
                    <label for="">Durum</label>
                    <label class="custom-switch mt-12">
                        <input type="checkbox" {{ $homepage_section_banner_one->banner_one->status==1 ? 'checked' : '' }} name="banner_two_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset($homepage_section_banner_one->banner_one->banner_image) }}" width="150px" alt="">
                </div>
                <div class="form-group">
                    <label for="">Banner Resim</label>
                    <input type="file" class="form-control" name="banner_image" value="">
                    <input type="hidden" value="{{ $homepage_section_banner_one->banner_one->banner_image }}" name=" " id="">
                </div>

                <div class="form-group">
                    <label for="">Banner Link</label>
                    <input type="text" class="form-control" name="banner_url" value="{{ $homepage_section_banner_one->banner_one->banner_url }}">
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
