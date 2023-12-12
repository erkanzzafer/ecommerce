@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>log Kategori Düzenle</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Blog Kategori Düzenle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.blog.update',$blogCategory->id)}}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label >Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $blogCategory->name}}">
                    </div>
                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" >
                            <option value="1"  {{ $blogCategory->status==1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $blogCategory->status==0 ? 'selected' : '' }}>Pasif</option>
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
