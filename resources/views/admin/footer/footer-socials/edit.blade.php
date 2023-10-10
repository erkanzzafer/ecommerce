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
                            <h4>Sosyal Medya Güncelle</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-socials.update',$footer->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button class="btn btn-primary" role="iconpicker" data-icon="{{ $footer->icon }}" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" name="icon"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>İsim</label>
                                    <input type="text" class="form-control" name="name" value="{{ $footer->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" class="form-control" name="link" value="{{$footer->link }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Durum</label>
                                    <select id="inputState" class="form-control" name="status"value="{{ old('status') }}">
                                        <option {{ $footer->status == 1 ? 'selected' : '' }} value="1" selected>Aktif</option>
                                        <option {{ $footer->status == 0 ? 'selected' : '' }} value="0">Pasif</option>
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
