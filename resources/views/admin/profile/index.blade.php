@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row mt-sm-4">

                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="{{ route('admin.profile.updateProfile') }}" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>PROFİL gÜNCELLE</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <div>
                                            <img src="{{ asset(Auth::user()->image) }}" alt="" width="100"
                                                height="100">
                                        </div>
                                        <label>Fotoğraf</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}" required="">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ Auth::user()->email }}" required="">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-7">




                    <div class="card">
                        <form method="post" action="{{ route('admin.password.updatePassword') }}" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Şifre Güncelle</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col- col-12">
                                        <label>Geçerli Şifre</label>
                                        <input type="password" class="form-control" name="current_password" required="">
                                    </div>
                                    <div class="form-group col- col-12">
                                        <label>Yeni Şifre</label>
                                        <input type="password" class="form-control" name="password" required="">
                                    </div>
                                    <div class="form-group col- col-12">
                                        <label>Yeni Şifre Tekrar</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            required="">
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
