@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

  <section class="section">
    <div class="section-header">
      <h1>MArka Ekle</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>MArka Ekle</h4>

            </div>
            <div class="card-body">
              <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label for="">Logo</label>
                      <input type="file" class="form-control" name="logo" >
                  </div>

                  <div class="form-group">
                      <label for="">İsim</label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                  </div>



                  <div class="form-group">
                      <label for="inputState">Özellikler</label>
                      <select id="inputState" class="form-control" name="is_featured" value="">
                        <option value="" selected>Seçiniz</option>
                        <option value="1" selected>Evet</option>
                        <option value="0">Hayır</option>
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="inputState">Durum</label>
                    <select id="inputState" class="form-control" name="status" value="">
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
