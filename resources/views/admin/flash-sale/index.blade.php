@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash Sale End Date</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sale End Date</label>
                                        <input type="date" class="form-control" name="end_date"  value="{{ @$flashSale->end_date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-product') }}" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ürün Ekle</label>
                                       <select name="product_id" id="" class="form-control select2">
                                        <option value="">Seçiniz</option>
                                       @foreach ($products as $product )
                                             <option value="{{ $product->id }}">{{ $product->name }}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Ana Ekranda Görünsün mü?</label>
                                            <select name="show_at_home" id="" class="form-control select2">
                                                <option value="1">Evet</option>
                                                <option value="0">Hayır</option>
                                               </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Durum</label>
                                            <select name="status" id="" class="form-control select2">
                                                <option value="1">Evet</option>
                                                <option value="0">Hayır</option>
                                               </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Flash Sale Products</h4>

                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {

            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.flash-sale-status.change-status') }}",
                    method: 'put',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        });
    </script>

<script>
    $(document).ready(function() {

        $('body').on('click', '.change-at-home-status', function() {
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.flash-sale.show-at-home.change-status') }}",
                method: 'put',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        })
    });
</script>
@endpush
