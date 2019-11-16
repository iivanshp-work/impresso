<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Socialite;
use App\Http\Controllers\LA\UploadsController as UploadsController;
use Session;

class SocialController extends Controller
{
    /**
     * SocialController constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->middleware('guest');
        $this->middleware('redirects');
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
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $exception) {
            $userSocial = null;
        }
        if ($userSocial) {
            $user = User::where(['email' => $userSocial->getEmail()])->first();
            if ($user) {
                Auth::login($user, 1);
                return redirect(getenv('BASE_LOGEDIN_PAGE'));
            } else {
                // copy image
                $image = $userSocial->getAvatar();
                $photo = 0;
                if ($image) {
                    try {
                        $image = str_replace('?type=normal', 'jpg', $image);
                        $uploadController = new UploadsController;
                        $responseImage = $uploadController->upload_files(true, $image, ["width" => 200, "height" => 200], true);
                        if ($responseImage["status"] == "success") {
                            $photo = $responseImage["upload"]->id;
                        }
                    }catch (Exception $exception) {
                    }
                }
                $referringUserId = 0;
                $referralUUID = Session::has('referral_uuid') ? Session::get('referral_uuid') : null;
                if ($referralUUID) {
                    $user = User::where('uuid', $referralUUID)->first();
                    if ($user) {
                        $referringUserId = $user->id;
                    }
                }
                $user = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                    'type' => getenv('USERS_TYPE_USER'),
                    'provider_id' => $userSocial->getId(),
                    'provider' => $provider,
                    'photo' => $photo,
                    'uuid' => str_random(20),
                    'referring_user_id' => $referringUserId
                ]);
                Auth::login($user, 1);
                return redirect(getenv('BASE_LOGEDIN_PAGE'));
            }
        } else {
            return view('frontend.pages.signin', [
                'failed_social_login' => true,
                'provider' => $provider
            ]);
        }
    }
}
