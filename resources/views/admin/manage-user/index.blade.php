@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Kullanıcı Yönetimi</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kullanıcı Ekle</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.manage-user.create') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name ') }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email ') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Şifre</label>
                                            <input type="password" class="form-control" name="password"
                                                value="{{ old('password ') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Şifre Onay</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                value="{{ old('password_confirmation ') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Rol</label>
                                    <select id="inputState" class="form-control" name="role" value="{{ old('role') }}">
                                        <option value="" selected>Seçiniz</option>
                                        <option value="user" >Mağaza</option>
                                        <option value="vendor">Kullanıcı</option>
                                        <option value="admin">Admin</option>
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
