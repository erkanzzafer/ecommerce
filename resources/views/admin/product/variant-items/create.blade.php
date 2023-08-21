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
                <h4>Varyant Öge Ekle</h4>

              </div>
              <div class="card-body">
                <form action="{{ route('admin.products-variant-item.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label >Varyant İsim</label>
                        <input type="text" class="form-control" name="" value="{{ $variant->name}}" readonly>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="variant_id" value="{{ $variant->id}}" readonly>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="product_id" value="{{ $product->id}}" readonly>
                    </div>

                    <div class="form-group">
                        <label >Oge İsim</label>
                        <input type="text" class="form-control" name="name" value="{{ old('item_name ') }}">
                    </div>
                    <div class="form-group">
                        <label >Ücret <code>(Ücretsiz için 0 giriniz)</code></label>
                        <input type="text" class="form-control" name="price" value="{{ old('price ') }}">
                    </div>



                    <div class="form-group">
                        <label for="inputState">Varsayılan</label>
                        <select id="inputState" class="form-control" name="is_default" >
                            <option value="1" selected>Evet</option>
                            <option value="0">Hayır</option>
                        </select>
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
