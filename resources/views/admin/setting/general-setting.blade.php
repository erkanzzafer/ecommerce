<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{ route('admin.general-setting-update') }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="">Site İsmi</label>
                <input type="text" class="form-control" name="site_name" value="{{ $genelralSetting->site_name }}">
            </div>
            <div class="form-group">
                <label for="">Görünüm</label>
                <select  class="form-control" name="layout" value="">
                    <option value="LTR" {{ $genelralSetting->layout=='LTR' ? 'selected' : '' }}>Soldan Sağa</option>
                    <option value="RTL" {{ $genelralSetting->layout=='RTL' ? 'selected' : '' }}>Sağdan Sola</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">İletişi Email</label>
                <input type="text" class="form-control" name="contact_email" value="{{ $genelralSetting->contact_email }}">
            </div>
            <div class="form-group">
                <label for="">Varsayılan Para Birimi </label>
                <select  class="form-control select2" name="currency_name" value="">
                    <option value="">Seçiniz</option>
                    @foreach (config('settings.currency_list') as $currency)
                    <option value="{{ $currency }}" {{ $currency == $genelralSetting->currency_name ? 'selected' : '' }}>{{ $currency }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Para Bimiri İkon</label>
                <input type="text" class="form-control" name="currency_icon" value="{{ $genelralSetting->currency_icon }}">
            </div>
            <div class="form-group">
                <label for="">Saat Dilimi </label>
                <select  class="form-control select2" name="time_zone" value="">
                    <option value="">Seçiniz</option>
                    @foreach (config('settings.time_zone') as  $key => $time_zone)
                    <option value="{{ $key }}" {{ $key == $genelralSetting->time_zone ? 'selected' : '' }}>{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</div>
</div>
