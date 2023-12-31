@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Kategori Düzenle</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Kategori Düzenle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.category.update',$category->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label >Icon</label>
                       <div>
                        <button class="btn btn-primary" role="iconpicker" data-selected-class="btn-danger"
                        data-unselected-class="btn-info" name="icon" data-icon="{{ $category->icon }}"> </button>
                       </div>
                    </div>
                    <div class="form-group">
                        <label >Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" >
                            <option value="1" {{ $category->status ==1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0"  {{ $category->status ==0 ? 'selected' : '' }}>Pasif</option>
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
