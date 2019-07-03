<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Validator;
use Redirect;

class SignController extends Controller
{
    public function signinPage(Request $request) {
        return view('frontend.pages.signin');
    }

    public function signupPage(Request $request) {
        return view('frontend.pages.signup');
    }

    public function signin(Request $request) {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($request->all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('sign-in')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => $request->input('email'),
                'password'  => $request->input('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                echo 'SUCCESS!';

            } else {
                // validation not successful, send back to form
                return Redirect::to('login');

            }

        }

        return view('frontend.pages.signin');
    }

    public function signup(Request $request) {
        dd($request->all());

        /*
        $user = User::where(['email' => $request->input('email')])->first();
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
        }*/
        return view('frontend.pages.signup');
    }
}
