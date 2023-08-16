@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Slider Oluştur</h1>
      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Slider Oluştur</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Banner</label>
                        <input type="file" class="form-control" name="banner" >
                    </div>

                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" class="form-control" name="type" value="{{ old('type') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Başlık</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Fiyat</label>
                        <input type="text" class="form-control" name="starting_price" value="{{ old('starting_price') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Buton URL</label>
                        <input type="text" class="form-control"  name="btn_url" value="{{ old('btn_url') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Seri</label>
                        <input type="text" class="form-control" name="serial"  value="{{ old('serial') }}">
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


