<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $genelralSetting = GeneralSetting::first();
        $emailSettings = EmailConfiguration::first();
        return view('admin.setting.index', compact('genelralSetting', 'emailSettings'));
    }

    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name'        => 'required|max:200',
            'layout'           => 'required|max:200',
            'contact_email'    => 'required|max:200',
            'contact_phone'    => 'required|max:200',
            'contact_address'  => 'required|max:200',
            'map'              => 'required|url',
            'currency_name'    => 'required|max:200',
            'currency_icon'    => 'required|max:200',
            'time_zone'        => 'required|max:200',
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
                'contact_address' => $request->contact_address,
                'map' => $request->map,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone,
            ]
        );

        toastr('Güncelleme Başarılı', 'success');
        return redirect()->back();
    }

    public function emailConfigSettingUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'host' => 'required|max:200',
            'username' => 'required|max:200',
            'password' => 'required|max:200',
            'port' => 'required|max:200',
            'encryption' => 'required|max:200',
        ]);

        EmailConfiguration::updateOrCreate(['id' => 1], [
            'email' => $request->email,
            'host' => $request->host,
            'username' => $request->username,
            'password' => $request->password,
            'port' => $request->port,
            'encryption' => $request->encryption,
        ]);

        toastr('Güncelleme başarılı', 'success', 'Başarılı');
        return redirect()->back();
    }
}
