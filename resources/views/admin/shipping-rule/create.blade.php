@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Shipping Rule Ekle</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Rule Ekle</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.shipping-rule.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>İsim</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name ') }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Tür</label>
                                    <select id="inputState" class="form-control shipping-type" name="type">
                                        <option value="flat_cost" selected>Flat Cost</option>
                                        <option value="min_cost">Minimum Order Amount</option>
                                    </select>
                                </div>

                                <div class="form-group min_cost d-none">
                                    <label>Minimum Miktar</label>
                                    <input type="text" class="form-control" name="min_cost" value="{{ old('name ') }}">
                                </div>

                                <div class="form-group">
                                    <label>Ücret</label>
                                    <input type="text" class="form-control" name="cost" value="{{ old('name ') }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Durum</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1" selected>Aktif</option>
                                        <option value="0">Pasif</option>
                                    </select>
                                </div>


                                <button type="submit" id="theButton" onclick="disableButton()"
                                    class="btn btn-primary">Kaydet</button>
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
     $(document).ready(function(){
        $('body').on('change','.shipping-type',function(){
            let value=$(this).val();
            if(value!='min_cost'){
                $('.min_cost').addClass('d-none');
            }else{
                $('.min_cost').removeClass('d-none');
            }
        })
     })
    </script>
@endpush
