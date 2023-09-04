@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Kupon Ekle</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kupon Ekle</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.coupons.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>İsim</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name ') }}">
                                </div>
                                <div class="form-group">
                                    <label>kod</label>
                                    <input type="text" class="form-control" name="code" value="{{ old('name ') }}">
                                </div>

                                <div class="form-group">
                                    <label>Adet</label>
                                    <input type="text" class="form-control" name="quantity" value="{{ old('name ') }}">
                                </div>

                                <div class="form-group">
                                    <label>Kişi için Maksimum KUllanım</label>
                                    <input type="text" class="form-control" name="max_use" value="{{ old('name ') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Başlangıç Tarihi</label>
                                            <input type="date" class="form-control date-picker" name="start_date"
                                                value="{{ old('name ') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bitiş Tarihi</label>
                                            <input type="date" class="form-control date-picker" name="end_date"
                                                value="{{ old('name ') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">İndirim Türü</label>
                                            <select id="inputState" class="form-control" name="discount_type">
                                                <option value="percent" selected>Yüzdelik (%)</option>
                                                <option value="amount" >Miktar ({{ $settings->currency_icon }})</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label>İndirim Değeri</label>
                                        <input type="text" class="form-control" name="discount_value"
                                            value="{{ old('name ') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Durum</label>
                                    <select id="inputState" class="form-control" name="status">
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.subcategory').empty();
                        $.each(data, function(i, item) {
                            $('.subcategory').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                })
            })
        });
    </script>
@endpush
