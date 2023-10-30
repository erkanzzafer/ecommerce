@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Mağaza Şartları</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Mağaza Şartları</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendor-condition.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>İçerik</label>
                                    <textarea name="content" class="summernote">{{ $vendorCondition->content }}</textarea>
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
