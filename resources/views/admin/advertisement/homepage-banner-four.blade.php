<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.homepage-banner-section-four') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Durum</label>
                    <label class="custom-switch mt-12">
                        <input type="checkbox"
                            {{ @$homepage_section_banner_four->banner_four->status == 1 ? 'checked' : '' }} name="status"
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ @asset($homepage_section_banner_four->banner_four->banner_four_image) }}" width="150px"
                        alt="">
                </div>
                <div class="form-group">
                    <label for="">Banner Resim</label>
                    <input type="file" class="form-control" name="banner_four_image" value="">
                    <input type="hidden" value="{{ @$homepage_section_banner_four->banner_four->banner_four_image }}"
                        name="banner_four_old_image" id="">
                </div>

                <div class="form-group">
                    <label for="">Banner Link</label>
                    <input type="text" class="form-control" name="banner_url"
                        value="{{ @$homepage_section_banner_four->banner_four->banner_url }}">
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
