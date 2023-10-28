@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Mağaza İsteği</h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <td><b>İsim:</b> {{ $vendor->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Kullanıcı Email:</b> {{ $vendor->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mağaza Adı:</b> {{ $vendor->shop_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mağaza Email</b> {{ $vendor->shop_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mağaza Telefon</b> {{ $vendor->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mağaza Adres</b>{{ $vendor->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Açıklama</b>{{ $vendor->description }}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <form action="{{ route('admin.vendor-requests.change-status',$vendor->id) }}" method="post" >
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="">İşlem</label>
                                                <select name="status" class="form-control" data-id=""
                                                    id="payment_status">
                                                    <option {{ $vendor->status == 1 ? 'selected' : '' }} value="1">
                                                        Onaylandı</option>
                                                    <option {{ $vendor->status == 0 ? 'selected' : '' }} value="0">
                                                        Bekelemede</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
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
            $('#order_status').on('change', function() {
                let status = $(tdis).val();
                //alert(status)

                let id = $(tdis).data('id');
                $.ajax({
                    metdod: 'get',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {

                    }

                })
            })

            $('#payment_status').on('change', function() {
                let status = $(tdis).val();
                let id = $(tdis).data('id');
                $.ajax({
                    metdod: 'get',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {

                    }

                })
            })

            $('.print_invoice').on('click', function() {

                let printBody = $('.invoice-print');

                let originalContents = $('body').html();
                $('body').html(printBody.html());

                window.print();

                $('body').html(originalContents);

            })

        })
    </script>
@endpush
