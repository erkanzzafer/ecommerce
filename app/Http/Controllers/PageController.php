<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\GeneralSetting;
use App\Models\Terms;
use Illuminate\Http\Request;

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
}
