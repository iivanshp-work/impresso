<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Socialite;

class SocialController extends Controller
{
    /**
     * SocialController constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->middleware('guest');
    }

    /**
     * redirect to provider
     * @param $provider
     * @return mixed
     */
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * provider callback and Sign in / Sign up
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Callback($provider) {
        ini_set("display_errors", 1);
        error_reporting(E_ALL);
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $exception) {
            $userSocial = null;
            dd($exception->getMessage());
        }
        if ($userSocial) {
            $user = User::where(['email' => $userSocial->getEmail()])->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('home');
            } else {
                $user = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                    'provider_id' => $userSocial->getId(),
                    'provider' => $provider,
                ]);
                return redirect()->route('home');
            }
        }
    }
}
