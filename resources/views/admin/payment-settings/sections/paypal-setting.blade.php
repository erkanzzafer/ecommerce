<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{ route('admin.paypal-setting.update',1) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="">Paypal Durumu</label>
                <select  class="form-control" name="status" value="">
                    <option {{ $paypalSetting->status=="1" ? 'selected' : '' }} value="1">Aktif</option>
                    <option {{ $paypalSetting->status=="0" ? 'selected' : '' }} value="0" >Pasif</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Hesap Mod</label>
                <select  class="form-control" name="mode" value="">
                    <option {{ $paypalSetting->mode=="0" ? 'selected' : '' }} value="1">SandBox</option>
                    <option {{ $paypalSetting->mode=="1" ? 'selected' : '' }} value="0" >Live</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Ülke</label>
                <select  class="form-control select2" name="country" value="">
                    <option value="1">Seçiniz</option>
                    @foreach (config('settings.country_list') as $country )
                    <option {{ $paypalSetting->country_name==$country  ? 'selected' : '' }}  value="{{ $country }}" >{{ $country }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Para Birimi</label>
                <select  class="form-control select2" name="currency_name" value="">
                    <option value="1">Seçiniz</option>
                    @foreach (config('settings.currency_list') as $key=>  $value )
                    <option  {{ $paypalSetting->currency_name==$value  ? 'selected' : '' }} value="{{ $value }}" >{{ $key }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="">Dolar Kur ($)</label>
                <input type="text" class="form-control" name="currency_rate" value="{{ $paypalSetting->currency_rate}}">
            </div>

            <div class="form-group">
                <label for="">Paypal Client ID</label>
                <input type="text" class="form-control" name="client_id" value="{{ $paypalSetting->client_id}}">
            </div>

            <div class="form-group">
                <label for="">Paypal KEY</label>
                <input type="text" class="form-control" name="secret_key" value="{{ $paypalSetting->secret_key}}">
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</div>
</div>
