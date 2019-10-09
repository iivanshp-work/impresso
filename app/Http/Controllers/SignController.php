<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Mails;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Validator;
use Redirect;
use Hash;
use Session;

use App\Http\Controllers\LA\UploadsController as UploadsController;

class SignController extends Controller
{
    /**
     * SignController constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->middleware('guest', ['except' => ['validation', 'validationPage']]);
        $this->middleware('auth', ['only' => ['validation', 'validationPage']]);
        $this->middleware('redirects');
    }

    /**
     * Sign In Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signinPage(Request $request) {
        return view('frontend.pages.signin');
    }

    /**
     * Sign Up Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signupPage(Request $request) {
        return view('frontend.pages.signup');
    }

    /**
     * Sign In functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signin(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => '',
            'redirect' => ''
        ];

        $rules = array(
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
            if (Auth::attempt($userdata, 1)) {
                $user = User::where('email', '=', $request->input('email'))->users()->NotDeleted()->first();
                if ($user) {
                    Auth::login($user, 1);
                    $user = Auth::user();
                    $redirectURL = $user && $user->is_verified ? getenv('BASE_LOGEDIN_PAGE') : getenv('VALIDATION_PAGE');
                    $responseData['redirect'] = url($redirectURL);
                    $responseData['user'] = Auth::user();
                    Session::put('session_start', Carbon::now()->format("Y-m-d H:i:s"));
                    Session::save();
                } else {
                    Auth::logout();
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'Login failed wrong user credentials.';
                }
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'Login failed wrong user credentials.';
            }
        }
        return response()->json($responseData);
    }

    /**
     * Sign up functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => '',
            'redirect' => ''
        ];

        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|confirmed|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            $checkUser = User::where('email', '=', $request->input('email'))->users()->NotDeleted()->first();
            if ($checkUser) {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'User with entered email already exists.';
            } else {
                $user = User::create([
                    'name' => '',
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'provider_id' => uniqid(),
                    'provider' => 'site',
                    'is_verified' => 0,
                    'type' => getenv('USERS_TYPE_USER'), // default user
                ]);
                if (isset($user->id)) {
                    $userdata = array(
                        'email' => $request->input('email'),
                        'password' => $request->input('password')
                    );
                    if (Auth::attempt($userdata, 1)) {
                        $user = User::where('email', '=', $request->input('email'))->first();
                        Auth::login($user, 1);

                        $mail = new Mails;
                        $mail->signup_email($user, $request->input('password'));

                        $responseData['redirect'] = url(getenv('VALIDATION_PAGE'));
                        Session::put('session_start', Carbon::now()->format("Y-m-d H:i:s"));
                        Session::save();
                    } else {
                        $responseData['has_error'] = true;
                        $responseData['message'] = 'Error while sign-in.';
                    }
                } else {
                    $responseData['has_error'] = true;
                    $responseData['message'] = 'Error while saving data.';
                }
            }
        }
        return response()->json($responseData);
    }

    /**
     * Validation Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validationPage(Request $request) {
        $user = Auth::user();
        if ($user && ($user->varification_pending || $user->is_verified)) {
            return redirect(getenv('BASE_LOGEDIN_PAGE'));
        }
        return view('frontend.pages.validation', [
            'user' => $user
        ]);
    }

    /**
     * Validation functionality
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validation(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => '',
            'redirect' => '',
            'id' => '',
            'image' => null,
        ];

        $action = $request->has('action') ? trim($request->input('action')) : '';
        $id = $request->has('id') ? trim($request->input('id')) : '';
        if ($action) {
            switch ($action) {
                case 'upload':
                    $user = Auth::user();
                    $uploadController = new UploadsController();
                    $responseImage = $uploadController->upload_files(true);
                    if ($responseImage["status"] == "success") {
                        $user->{$id} = $responseImage["upload"]->id;
                        $user->save();
                        $responseData['image'] = $responseImage["upload"];
                        $responseData['id'] = $id;
                    } else {
                        $responseData['has_error'] = true;
                        $responseData['message'] = 'An error occurred while submited photo. Please try again later.';
                    }
                    break;
                case 'check_validation':
                    $user = Auth::user();
                    if ($user && $user->photo_id && $user->photo_selfie) {
                        $user->varification_pending = 1;
                        $user->fail_validation = 0;
                        $user->save();
                    } else {
                        $responseData['has_error'] = true;
                        $responseData['message'] = 'Profile cannot be validated, try again upload data.';
                    }
                    break;
                default:
                    break;
            }
        }
        return response()->json($responseData);
    }
}
