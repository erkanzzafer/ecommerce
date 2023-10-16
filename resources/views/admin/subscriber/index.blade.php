@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Subscribers</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tüm Üyelere Email Gönder</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>Yeni Ekle</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subscribers-send-email') }}" class="form-group" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Konu</label>
                                    <input type="text" class="form-control" name="subject">
                                </div>
                                <div class="form-group">
                                    <label for="">Mesaj</label>
                                    <textarea name="message" class="form-control" id="" ></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gönder</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tüm Üyeler</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>Yeni Ekle</a>
                            </div>
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
                    url: "{{ route('admin.product.change-status') }}",
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
