<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function newsLetterRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email girilmesi zorunludur',
            'email.email' => 'Geçerli bir email giriniz.',
        ]);

        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();
        if (!empty($existSubscriber)) {
            if ($existSubscriber->is_verified == 0) {
                //send verification link here
                $existSubscriber->verified_token = Str::random(25);
                $existSubscriber->save();
                MailHelper::setMailConfig();
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));
                return response(['status' => 'success', 'message' => 'Doğrulama için epostanıza gelen linke tıklayın']);
            } else if ($existSubscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => 'Bu email zaten listeye eklenmiş']);
            }
        } else {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();


            //set mail config
            MailHelper::setMailConfig();

            //send mail
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
            return response(['status' => 'success', 'message' => 'Doğrulama için epostanıza gelen linke tıklayın']);
        }
    }



    public function newsLetterEmailVerify($token)
    {
        $verify = NewsletterSubscriber::where('verified_token', $token)->first();
        if ($verify) {
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();
            toastr('Email doğrulandı', 'success', 'Başarılı!');
            return redirect()->route('home');
        } else {
            toastr('Geçersiz token', 'success', 'Başarılı!');
            return redirect()->route('home');
        }
    }
}
