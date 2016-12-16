<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Controllers\BaseController;
use App\Services\SocialLoginService;
use Auth;

class SocialServiceController extends BaseController
{
    public function getSocialRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function getSocialHandle(SocialLoginService $service, $provider)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider));
        Auth::login($user, true);
        return redirect()->action('HomeController@index');
    }
}
