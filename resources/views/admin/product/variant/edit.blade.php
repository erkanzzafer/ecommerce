@extends('admin.layouts.master')
@section('content')
  <!-- Main Content -->

    <section class="section">
      <div class="section-header">
        <h1>Ürün Varyant Güncelle</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Varyant Güncelle</h4>
                <br>
                <br>
                <div class="mb-3">
                    <a href="{{ route('admin.products-variant.showTable',$product_variant->product_id) }}" class="btn btn-primary" >Geri Dön </a>
                 </div>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.products-variant.update',$product_variant->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label >Varyant İsmi</label>
                        <input type="text" class="form-control" name="name" value={{ $product_variant->name}}>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Durum</label>
                        <select id="inputState" class="form-control" name="status" value="{{ old('status') }}">
                            <option value="1" {{ $product_variant->status==1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $product_variant->status==0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    <input type="hidden" name="product_id" value="{{ request()->product }}">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </form>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

@endsection
