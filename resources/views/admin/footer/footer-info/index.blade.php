@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Footer</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Footer Bilgi</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-info.update', 1) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">

                                    <img src="{{ asset($footerInfo->logo) }}" width="100" height="100" alt="">
                                    <label>Footer Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telefon</label>
                                            <input type="text" class="form-control" name="phone" value="{{ $footerInfo->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{ $footerInfo->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Adres</label>
                                    <input type="text" class="form-control" name="address" value="{{ $footerInfo->address }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Copyright</label>
                                    <input type="text" class="form-control" name="copyright" value="{{ $footerInfo->copyright }}">
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
