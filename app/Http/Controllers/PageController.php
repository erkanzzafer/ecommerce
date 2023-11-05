<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view("frontend.pages.about", compact("about"));
    }

    public function termsPage(Request $request)
    {
        $terms = Terms::first();
        return view("frontend.pages.terms", compact("terms"));
    }

    public function contactPage(Request $request)
    {
        $setting = GeneralSetting::first();
        return view("frontend.pages.contact", compact("setting"));
    }

    public function handleContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|email',
            'subject' => 'required|max:200',
            'message' => 'required|max:1000',
        ]);


        $setting = EmailConfiguration::first();
        Mail::to($setting->email)->send(new Contact($request->subject, $request->message, $request->email));
        return response(['status' => 'success', 'message' => 'Email başarıyla gönderildi']);
    }
}
