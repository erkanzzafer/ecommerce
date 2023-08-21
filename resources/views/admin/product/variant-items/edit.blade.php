@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Ürün Varyant Öge Ekle</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Varyant Öge Güncelle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.products-variant-item.update',$variant->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label >Varyant Öge Güncelle</label>
                        <input type="text" class="form-control" name="" value="{{ $variant->productVariant->name }}" readonly>
                    </div>


                    <div class="form-group">
                        <label >Oge İsim</label>
                        <input type="text" class="form-control" name="name" value="{{ $variant->name }}">
                    </div>
                    <div class="form-group">
                        <label >Ücret <code>(Ücretsiz için 0 giriniz)</code></label>
                        <input type="text" class="form-control" name="price" value="{{ $variant->price }}">
                    </div>



                    <div class="form-group">
                        <label for="inputState">Varsayılan</label>
                        <select id="inputState" class="form-control" name="is_default" >
                            <option value="1" {{ $variant->is_default == 1  ? 'selected' : '' }}>Evet</option>
                            <option value="0" {{ $variant->is_default == 0  ? 'selected' : '' }}>Hayır</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                            <option value="1" {{ $variant->status == 1 ? 'selected'  : '' }}>Aktif</option>
                            <option value="0" {{ $variant->status == 0 ? 'selected'  : '' }}>Pasif</option>
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
