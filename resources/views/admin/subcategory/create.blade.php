@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Alt Kategori Ekle</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Alt Kategori Ekle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.subcategory.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputState">Alt Kategori</label>
                        <select id="inputState" class="form-control" name="category">
                            <option selected>Seçiniz</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name ') }}">
                    </div>
                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" >
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
