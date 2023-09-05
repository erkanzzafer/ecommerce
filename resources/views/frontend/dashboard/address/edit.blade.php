@extends('frontend.dashboard.layouts.master')
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                  <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="fal fa-gift-card"></i>Adres Güncelle</h3>
                    <div class="wsus__dashboard_add wsus__add_address">
                      <form action="{{ route('user.address.update', $user_address->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>name <b>*</b></label>
                              <input type="text" placeholder="Name" name="name" value="{{ $user_address->name }}">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>email</label>
                              <input type="email" placeholder="Email" name="email" value="{{ $user_address->email }}">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>phone <b>*</b></label>
                              <input type="text" placeholder="Phone" name="phone"  value="{{ $user_address->phone }}">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>Ülke <b>*</b></label>
                              <div class="wsus__topbar_select">
                                <select class="select_2" name="country">
                                    <option>Seçiniz</option>
                                   @foreach (config('settings.country_list') as $country)
                                   <option value="{{  $country }}" {{ $user_address->country== $country ? 'selected' : '' }}>{{  $country }}</option>
                                   @endforeach
                                  </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>state <b>*</b></label>
                              <div class="wsus__topbar_select">
                                <input type="text" placeholder="state" name="state"  value="{{ $user_address->state }}">
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>city <b>*</b></label>
                              <div class="wsus__topbar_select">
                                <input type="text" placeholder="Phone" name="city"  value="{{ $user_address->city }}">
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>zip code <b>*</b></label>
                              <input type="text" placeholder="Zip Code" name="zip"  value="{{ $user_address->zip }}">
                            </div>
                          </div>

                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                              <label>Address <b>*</b></label>
                              <input type="text" placeholder="Zip Code" name="address"  value="{{ $user_address->address }}">
                            </div>
                          </div>

                          <div class="col-xl-6">
                            <button type="submit" class="common_btn">Kaydet</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </section>
@endsection
