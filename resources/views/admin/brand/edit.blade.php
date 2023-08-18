@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

  <section class="section">
    <div class="section-header">
      <h1>Marka Güncelle</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Marka Güncelle</h4>

            </div>
            <div class="card-body">
              <form action="{{ route('admin.brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                     <div class="form-group">
                        <label >Görsel</label>
                        <img src="{{ asset($brand->logo) }}" width="200" alt="">
                    </div>
                  <div class="form-group">
                      <label for="">Logo</label>
                      <input type="file" class="form-control" name="logo" >
                  </div>

                  <div class="form-group">
                      <label for="">İsim</label>
                      <input type="text" class="form-control" name="name" value="{{ $brand->name}}">
                  </div>



                  <div class="form-group">
                      <label for="inputState">Özellikler</label>
                      <select id="inputState" class="form-control" name="is_featured" value="">
                        <option value="1" {{ $brand->is_featured==1 ? 'selected' : '' }}>Evet</option>
                        <option value="0" {{ $brand->is_featured==0 ? 'selected' : '' }}>Hayır</option>
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="inputState">Durum</label>
                    <select id="inputState" class="form-control" name="status" value="">
                        <option value="1" {{ $brand->status==1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $brand->status==0 ? 'selected' : '' }}>Pasif</option>
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
