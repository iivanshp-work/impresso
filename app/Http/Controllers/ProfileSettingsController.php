<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Mails;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Validator;
use Redirect;
use Hash;

use App\Http\Controllers\LA\UploadsController as UploadsController;

class ProfileSettingsController extends Controller
{
    /**
     * SignController constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->middleware('auth');
        $this->middleware('redirects');
    }

    /**
     * Profile Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profilePage(Request $request, $id = '') {
        $user = Auth::user();
        $mode = !$id || ($id && $user && $user->id == $id) ? 'me' : 'other';
        if ($mode != 'me') {
            $userData = User::where('id', '=', $id)->first();
        } else {
            $userData = $user;
        }
        return view('frontend.pages.profile', [
            'user' => $user,
            'mode' => $mode,
            'userData' => $userData
        ]);
    }

    /**
     * Profile Edit Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEditPage(Request $request) {
        $user = Auth::user();
        return view('frontend.pages.profile_edit', [
            'userData' => $user
        ]);
    }

    /**
     * Profile Edit functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileEdit(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => '',
            'redirect' => ''
        ];

        /*$rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            $userdata = array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
            );
            if (Auth::attempt($userdata)) {
                $user = Auth::user();
                $redirectURL = $user && $user->is_verified ? getenv('BASE_LOGEDIN_PAGE') : getenv('VALIDATION_PAGE');
                $responseData['redirect'] = url($redirectURL);
                $responseData['user'] = Auth::user();
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'Login failed wrong user credentials.';
            }
        }*/
        return response()->json($responseData);
    }
}
