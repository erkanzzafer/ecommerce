@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Slider</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Components</a></div>
          <div class="breadcrumb-item">Table</div>
        </div>
      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Slider Düzenle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label >Görsel</label>
                        <img src="{{ asset($slider->banner) }}" width="200" alt="">
                    </div>
                    <div class="form-group">
                        <label for="">Banner</label>
                        <input type="file" class="form-control" name="banner" >
                    </div>

                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" class="form-control" name="type" value="{{ $slider->type }}">
                    </div>

                    <div class="form-group">
                        <label for="">Başlık</label>
                        <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                    </div>

                    <div class="form-group">
                        <label for="">Fiyat</label>
                        <input type="text" class="form-control" name="starting_price" value="{{ $slider->starting_price }}">
                    </div>

                    <div class="form-group">
                        <label for="">Buton URL</label>
                        <input type="text" class="form-control"  name="btn_url" value="{{ $slider->btn_url }}">
                    </div>

                    <div class="form-group">
                        <label for="">Seri</label>
                        <input type="text" class="form-control" name="serial"  value="{{ $slider->serial }}">
                    </div>

                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                            <option value="1"{{$slider->status==1 ? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{$slider->status==0 ? 'selected' : ''}}>Pasif</option>
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


