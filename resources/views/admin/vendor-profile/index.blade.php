@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Mağaza Profili</h1>
      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Mağaza Güncelle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.vendor-profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">Önizleme</label>
                       <img width="200" src="{{asset( $profile->banner) }}" alt="">
                    </div>
                    <div class="form-group">
                        <label for="">Banner</label>
                        <input type="file" class="form-control" name="banner" >
                    </div>

                    <div class="form-group">
                        <label for="">Telefon</label>
                        <input type="text" class="form-control" name="phone" value="{{$profile->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $profile->email }}">
                    </div>
                    <div class="form-group">
                        <label for="">Adres</label>
                        <input type="text" class="form-control" name="address" value="{{ $profile->address }}">
                    </div>

                    <div class="form-group">
                        <label for="">Açıklama</label>
                        <textarea class="summernote" name="description">{{ $profile->description }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="">Facebook Link</label>
                        <input type="text" class="form-control" name="fb_link" value="{{$profile->fb_link }}">
                    </div>

                    <div class="form-group">
                        <label for="">Twitter Link</label>
                        <input type="text" class="form-control"  name="tw_link" value="{{ $profile->tw_link}}">
                    </div>

                    <div class="form-group">
                        <label for="">İnstagram Link</label>
                        <input type="text" class="form-control" name="insta_link"  value="{{ $profile->insta_link }}">
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


