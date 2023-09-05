@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Shipping Rule Güncelle</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Rule Güncelle</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.shipping-rule.update',$shipping->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>İsim</label>
                                    <input type="text" class="form-control" name="name" value="{{ $shipping->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Tür</label>
                                    <select id="inputState" class="form-control shipping-type" name="type">
                                        <option value="flat_cost"  {{ $shipping->type=='flat_cost' ? 'selected' : ''}} >Flat Cost</option>
                                        <option value="min_cost" {{ $shipping->type=='min_cost' ? 'selected' : ''}} >Minimum Order Amount</option>
                                    </select>
                                </div>

                                <div class="form-group min_cost {{ $shipping->type=='min_cost' ? '' : 'd-none' }}">
                                    <label>Minimum Miktar</label>
                                    <input type="text" class="form-control" name="min_cost" value="{{ $shipping->min_cost}}">
                                </div>

                                <div class="form-group">
                                    <label>Ücret</label>
                                    <input type="text" class="form-control" name="cost" value="{{ $shipping->cost}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Durum</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $shipping->status==1 ? 'selected' : '' }} value="1" selected>Aktif</option>
                                        <option {{ $shipping->status==0 ? 'selected' : '' }} value="0">Pasif</option>
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
