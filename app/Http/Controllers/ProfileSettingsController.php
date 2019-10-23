<?php

namespace App\Http\Controllers;

use App\Models\Buy_Credit;
use App\Models\Country;
use App\Models\Location;
use App\Models\Meetup;
use App\Models\Meetup_reason;
use App\Models\User_certification;
use App\Models\User_Education;
use App\Models\User_Purchase;
use App\Models\User_Resume;
use App\Models\User_Transaction;
use App\Models\Users_Notification;
use App\User;
use App\Models\User as UserModel;
use App\Models\Mails;
use Brick\PhoneNumber\PhoneNumberFormat;
use Carbon\Carbon;
use Dwij\Laraadmin\Models\LAConfigs;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Validator;
use Redirect;
use Hash;
use Stripe;
use DB;
use Session;

use Artisan;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberParseException;

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
            if (!$userData) {
                return redirect('/feeds');
            }
            $meetup = $userData ? $userData->meetup() : null;
        } else {
            $userData = $user;
            $meetup = null;
        }
        return view('frontend.pages.profile', [
            'user' => $user,
            'mode' => $mode,
            'userData' => $userData,
            'meetup' => $meetup
        ]);
    }

    /**
     * Profile Edit Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEditPage(Request $request, $step = '1') {
        $user = Auth::user();
        return view('frontend.pages.profile_edit', [
            'userData' => $user,
            'step' => $step
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
            'redirect' => url('/profile')
        ];
        $action = $request->has('action') ? trim($request->input('action')) : '';
        if ($action == 'upload_photo') {
            $id = $request->has('id') ? trim($request->input('id')) : '';
            $uploadController = new UploadsController;
            $responseImage = $uploadController->upload_files(true, null, ["width" => 200, "height" => 200]);
            if ($responseImage["status"] == "success") {
                $responseData['image'] = $responseImage["upload"];
                $responseData['id'] = $responseImage["upload"]->id;;
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] = 'An error occurred while submitted photo. Please try again later.';
            }
            return response()->json($responseData);
        } else if ($action == 'upload_profile_files') {
            $uploadController = new UploadsController;
            $files = array_key_exists("files", $request->all()) ? $request->all()["files"] : null;
            if ($files) {
                $filesIDS = [];
                foreach($files as $file) {
                    $responseFile = $uploadController->upload_files(true, $file);
                    if ($responseFile["status"] == "success") {
                        $filesIDS[] = $responseFile["upload"]->id;
                    } else {
                        $responseData['has_error'] = true;
                        $responseData['message'] = 'An error occurred while submitted files. Please try again.';
                        break;
                    }
                    if (!empty($files)) {
                        $responseData['files'] = json_encode($filesIDS);
                    }
                }
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] = 'An error occurred while submitted files. Please try again.';
            }
            return response()->json($responseData);
        } else if ($action == 'request_validation') {
            $responseData['id'] = 0;
            $responseData['no_xims'] = false;
            $user = Auth::user();
            $params['id'] = $request->has('id') ? intval($request->input('id')) : 0;
            $params['type'] = $request->has('type') ? trim($request->input('type')) : '';
            $params['title'] = $request->has('title') ? trim($request->input('title')) : '';
            $params['speciality'] = $request->has('speciality') ? trim($request->input('speciality')) : '';
            $params['url'] = $request->has('url') ? trim($request->input('url')) : '';
            $params['files'] = $request->has('files') ? trim($request->input('files')) : '';
            //start validation
            if (!$params['type']) {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'Type of document is invalid, contact support.';
            }
            if (!$params['title']) {
                $responseData['has_error'] = true;
                if ($params['type'] == 'education') {
                    $responseData['message'] .= 'School Name is empty.';
                } else if ($params['type'] == 'resume') {
                    $responseData['message'] .= 'CV/Resume is empty.';
                } else if ($params['type'] == 'certificate') {
                    $responseData['message'] .= 'Certificate Name is empty.';
                } else {
                    $responseData['message'] .= 'Title is empty.';
                }
            }
            if (!$params['speciality'] && $params['type'] == 'education') {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'Speciality is empty.';
            }
            if (!$params['url'] && !$params['files']) {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'URL or files are required.';
            }
            if ($responseData['has_error']) {
                return response()->json($responseData);
            }

            //check users balance and minus it
            $neededCredits = LAConfigs::getByKey('validation_value');
            if (!$neededCredits) {
                $neededCredits = 30;
            }
            $isResume = isset($params['type']) && $params['type'] == 'resume';

            if (!$isResume && $user->credits_count_value < $neededCredits) {
                $responseData['no_xims'] = true;
                //save notification
                Users_Notification::saveNotification('no_xims', 'You’re out of XIMs');
                return response()->json($responseData);
            }
            //save data
            if ($params['type'] == 'education') {
                $data = User_Education::find($params['id']);
                $newRecord = false;
                if (!$data) {
                    $data = new User_Education;
                    $newRecord = true;
                }
                $data->title = $params['title'];
                $data->speciality = $params['speciality'];
                $data->url = $params['url'];
                $data->files_uploaded = $params['files'];
                $data->status = getenv('VERIFIED_STATUSES_REQUEST_VERIFICATION');
                if ($newRecord) {
                    $data->user_id = $user->id;
                }
                $data->save();
            } elseif($params['type'] == 'resume') {
                $data = User_Resume::find($params['id']);
                $newRecord = false;
                if (!$data) {
                    $data = new User_Resume;
                    $newRecord = true;
                }
                $data->title = $params['title'];
                $data->url = $params['url'];
                $data->files_uploaded = $params['files'];
                $data->status = getenv('VERIFIED_STATUSES_REQUEST_VERIFICATION');
                if ($newRecord) {
                    $data->user_id = $user->id;
                }
                $data->save();
            }else {
                $data = User_certification::find($params['id']);
                $newRecord = false;
                if (!$data) {
                    $data = new User_certification;
                    $newRecord = true;
                }
                $data->title = $params['title'];
                $data->url = $params['url'];
                $data->files_uploaded = $params['files'];
                $data->status = getenv('VERIFIED_STATUSES_REQUEST_VERIFICATION');
                if ($newRecord) {
                    $data->user_id = $user->id;
                }
                $data->save();
            }
            if(!$isResume && $data->id) {
                //save in transcations
                $amount = 0 - $neededCredits;
                $User_Transaction = new User_Transaction;
                $User_Transaction->user_id = $user->id;
                $User_Transaction->amount = $amount;
                if ($params['type'] == 'education') {
                    $User_Transaction->type = 'validation_education';
                    $User_Transaction->notes = 'Education Validation "' . $data->title . '" - #' . $data->id;
                    $User_Transaction->education_id = $data->id;
                } else {
                    $User_Transaction->type = 'validation_certificate';
                    $User_Transaction->notes = 'Certificate Validation "' . $data->title . '" - #' . $data->id;
                    $User_Transaction->certificate_id = $data->id;
                }
                $User_Transaction->by_user_id = $user->id;
                $User_Transaction->old_credits_amount = $user->credits_count_value;
                $User_Transaction->new_credits_amount = $user->credits_count_value + $amount;
                $User_Transaction->save();

                //adjust user credits amount
                $user->credits_count = $user->credits_count_value + $amount;
                $user->save();
            }
            $responseData['id'] = $data->id;
            return response()->json($responseData);
        } else if ($action == 'check_step') {
            $step = $request->has('step') ? trim($request->input('step')) : '1';
            $allowedSteps = ['1', '2'];
            //test($allowedSteps);
            if (in_array($step, $allowedSteps)) {
                $rules = array(
                    '1' => array(
                        'name' => 'required|string', // make sure the name is an actual string
                        'company_title' => 'required|string', // company_title can only be alphanumeric
                        'job_title' => 'required|string', // company_title can only be alphanumeric,
                        'university_title' => 'required|string', // university_title can only be alphanumeric
                        'certificate_title' => 'required|string', // certificate_title can only be alphanumeric
                    ),
                    '2' => array(
                        'impress' => 'required|string', // impress can only be alphanumeric
                        "top_skills"    => "required|array|min:1",
                        "top_skills.0"  => "required|string|distinct|min:1",
                        "soft_skills"    => "required|array|min:1",
                        "soft_skills.0"  => "required|string|distinct|min:1",
                    ),
                );
                $validator = Validator::make($request->all(), $rules[$step]);
                if ($validator->fails()) {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'Please fill in all mandatory fields marked by an asterisk symbol ( * ).<br>';
                }
                $id = Auth::id();
                $user = UserModel::find($id);
                if ($step == '1') {
                    $user->photo = $request->has('photo') ? intval($request->input('photo')) : 0;
                    $user->name = $request->has('name') ? trim($request->input('name')) : '';
                    $user->company_title = $request->has('company_title') ? trim($request->input('company_title')) : '';
                    $user->job_title = $request->has('job_title') ? trim($request->input('job_title')) : '';
                    $user->university_title = $request->has('university_title') ? trim($request->input('university_title')) : '';
                    $user->certificate_title = $request->has('certificate_title') ? trim($request->input('certificate_title')) : '';
                } else if ($step == '2') {
                    $topSkills = $request->has('top_skills') ? implode("\n", $request->input('top_skills')) : '';
                    $softSkills = $request->has('soft_skills') ? implode("\n", $request->input('soft_skills')) : '';
                    $user->impress = $request->has('impress') ? trim($request->input('impress')) : '';
                    $user->top_skills = $topSkills;
                    $user->soft_skills = $softSkills;
                }
                if ($user->save()) {
                } else {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'An error occurred while saving data.' . '<br>';
                }
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'Steps error occurred. Please try again later.';
            }
            return response()->json($responseData);
        }

        $rules = array(
            /*'name' => 'required|string', // make sure the name is an actual string
            'company_title' => 'required|string', // company_title can only be alphanumeric
            'job_title' => 'required|string', // company_title can only be alphanumeric,
            'impress' => 'required|string', // impress can only be alphanumeric
            "top_skills"    => "required|array|min:1",
            "top_skills.0"  => "required|string|distinct|min:1",
            "soft_skills"    => "required|array|min:1",
            "soft_skills.0"  => "required|string|distinct|min:1",*/
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $responseData['message'] .= 'Please fill in all mandatory fields marked by an asterisk symbol ( * ).<br>';
        } else {
            $id = Auth::id();
            $user = UserModel::find($id);
            //$topSkills = $request->has('top_skills') ? implode("\n", $request->input('top_skills')) : '';
            //$softSkills = $request->has('soft_skills') ? implode("\n", $request->input('soft_skills')) : '';
            //$user->photo = $request->has('photo') ? intval($request->input('photo')) : 0;
            //$user->name = $request->has('name') ? trim($request->input('name')) : '';
            //$user->company_title = $request->has('company_title') ? trim($request->input('company_title')) : '';
            //$user->job_title = $request->has('job_title') ? trim($request->input('job_title')) : '';
            //$user->university_title = $request->has('university_title') ? trim($request->input('university_title')) : '';
            //$user->certificate_title = $request->has('certificate_title') ? trim($request->input('certificate_title')) : '';
            //$user->impress = $request->has('impress') ? trim($request->input('impress')) : '';
            //$user->top_skills = $topSkills;
            //$user->soft_skills = $softSkills;
            $existEducations = $user->educations()->get();
            $idsSaved = [];
            if ($request->has('education')) {
                $educations = $request->input('education');
                unset($educations['%KEY%']);
                if (!empty($educations)) {
                    foreach ($educations as $education) {
                        if (!$education['id'] && ($education['title'] || $education['speciality'])) {
                            $data = new User_Education;
                            $data->user_id = $id;
                            $data->title = $education['title'];
                            $data->speciality = $education['speciality'];
                            $data->url = '';
                            $data->files_uploaded = '[]';
                            $data->status = getenv('VERIFIED_STATUSES_NEW');
                            $data->save();
                        } else if ($education['id']) {
                            $idsSaved[] = $education['id'];
                            $data = User_Education::find($education['id']);
                            if ($data && $data->status == getenv('VERIFIED_STATUSES_NEW')) {
                                $data->title = $education['title'];
                                $data->speciality = $education['speciality'];
                                $data->save();
                            }
                        }
                    }
                }
            }
            foreach ($existEducations as $education) {
                if (!in_array($education->id, $idsSaved)) {
                    $education->delete();
                }
            }
            $existCertifications = $user->certifications()->get();
            $idsSaved = [];
            if ($request->has('certificate')) {
                $certificates = $request->input('certificate');
                unset($certificates['%KEY%']);
                if (!empty($certificates)) {
                    foreach ($certificates as $certificate) {
                        if (!$certificate['id'] && ($certificate['title'])) {
                            $data = new User_certification;
                            $data->user_id = $id;
                            $data->title = $certificate['title'];
                            $data->url = '';
                            $data->files_uploaded = '[]';
                            $data->status = getenv('VERIFIED_STATUSES_NEW');
                            $data->save();
                        } else if ($certificate['id']) {
                            $idsSaved[] = $certificate['id'];
                            $data = User_certification::find($certificate['id']);
                            if ($data && $data->status == getenv('VERIFIED_STATUSES_NEW')) {
                                $data->title = $certificate['title'];
                                $data->save();
                            }
                        }
                    }
                }
            }
            foreach ($existCertifications as $certification) {
                if (!in_array($certification->id, $idsSaved)) {
                    $certification->delete();
                }
            }

            $existResumes = $user->resumes()->get();
            $idsSaved = [];
            if ($request->has('resume')) {
                $resumes = $request->input('resume');
                unset($resumes['%KEY%']);
                if (!empty($resumes)) {
                    foreach ($resumes as $resume) {
                        if (!$resume['id'] && ($resume['title'])) {
                            $data = new User_Resume;
                            $data->user_id = $id;
                            $data->title = $resume['title'];
                            $data->url = '';
                            $data->files_uploaded = '[]';
                            $data->status = getenv('VERIFIED_STATUSES_NEW');
                            $data->save();
                        } else if ($resume['id']) {
                            $idsSaved[] = $resume['id'];
                            $data = User_Resume::find($resume['id']);
                            if ($data && $data->status == getenv('VERIFIED_STATUSES_NEW')) {
                                $data->title = $resume['title'];
                                $data->save();
                            }
                        }
                    }
                }
            }
            foreach ($existResumes as $resume) {
                if (!in_array($resume->id, $idsSaved)) {
                    $resume->delete();
                }
            }

            try {
                if ($user->save()) {
                    $responseData['message'] = 'Profile data successfully saved.';
                } else {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'An error occurred while saving data.' . '<br>';
                }
            } catch (\Exception $e) {
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            }
        }
        return response()->json($responseData);
    }

    /**
     * Settings Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsPage(Request $request) {
        $user = Auth::user();
        return view('frontend.pages.settings', [
            'user' => $user,
            'userData' => $user
        ]);
    }

    /**
     * Settings Edit Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsEditPage(Request $request) {
        //updates meetup expires
        // cron example
        //* * * * * cd /var/www/html/laravelPath && php artisan schedule:run >> /dev/null 2>&1
        $exitCode = Artisan::call('meetups_expires', []);

        $user = Auth::user();
        return view('frontend.pages.settings_edit', [
            'user' => $user,
            'userData' => $user
        ]);
    }

    /**
     * Settings Edit
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsEdit(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => ''
        ];
        $rules = array(
            'full_name_birth' => 'required|string',
            'birth_date' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[\+0-9\- \(\)]{5,25}$/'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            if (!$this->validatePhoneNumber($request->input('phone'))) {
                $responseData['has_error'] = true;
                $responseData['message'] = 'Invalid phone number.';
                return response()->json($responseData);
            }

            $id = Auth::id();
            $user = UserModel::find($id);
            $user->full_name_birth = $request->has('full_name_birth') ? trim($request->input('full_name_birth')) : '';
            $user->birth_date = $request->has('birth_date') ? trim($request->input('birth_date')) : '';
            $user->email = $request->has('email') ? trim($request->input('email')) : '';
            $user->phone = $this->formatPhoneNumber($request->has('phone') ? trim($request->input('phone')) : '');
            $user->address = $request->has('address') ? trim($request->input('address')) : '';
            $user->address2 = $request->has('address2') ? trim($request->input('address2')) : '';
            $user->city = $request->has('city') ? trim($request->input('city')) : '';
            try {
                $checkUser = User::where('email', '=', $user->email)->notMe()->users()->NotDeleted()->first();
                if ($checkUser) {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'User with entered email already exists.';
                } else {
                    if ($user->save()) {
                        $responseData['message'] = 'Personal data successfully saved.';
                    } else {
                        $responseData['has_error'] = true;
                        $responseData['message'] .= 'An error occurred while saving data.' . '<br>';
                    }
                }
            } catch (\Exception $e) {
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            }
        }
        return response()->json($responseData);
    }

    /**
     * Settings Change Password Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsChangePasswordPage(Request $request) {
        $user = Auth::user();
        return view('frontend.pages.settings_change_password', [
            'user' => $user
        ]);
    }

    /**
     * Settings Change Password
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsChangePassword(Request $request) {
        $id = Auth::id();
        $user = UserModel::find($id);

        $responseData = [
            'has_error' => false,
            'message' => ''
        ];

        $rules = array(
            'old_password' => 'required|string',
            'password' => 'required|confirmed|min:3|regex:' . getenv('PASSWORD_REGEX'),
        );
        if ($user->provider != 'site') {
            unset($rules['old_password']);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            if ($user->provider == 'site' && !Hash::check($request->input('old_password'), $user->password)) {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'Wrong old password.<br>';
                return response()->json($responseData);
            }
            $user->password = Hash::make($request->input('password'));
            try {
                if ($user->save()) {
                    $responseData['message'] = 'Password successfully changed.';
                    //send message
                    $mail = new Mails;
                    $mail->change_password($user, $request->input('password'));
                } else {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'An error occurred while saving data.' . '<br>';
                }
            } catch (\Exception $e) {
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            }
        }
        return response()->json($responseData);
    }

    /**
     * Settings Credits Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsCreditsPage(Request $request) {
        $user = Auth::user();
        $purchaseTypes = Buy_Credit::all();
        return view('frontend.pages.settings_credits', [
            'userData' => $user,
            'purchaseTypes' => $purchaseTypes,
        ]);
    }

    /**
     * Settings Credits Checkout Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsCreditsCheckoutPage(Request $request) {
        $user = Auth::user();
        $purchaseTypeID = $request->has('type') ? $request->input('type') : 0;
        $purchaseType = Buy_Credit::find($purchaseTypeID);
        if (!$purchaseType) {
            $purchaseType = Buy_Credit::first();
        }
        if (!$purchaseType) {
            return redirect('/settings/credits');
        }
        return view('frontend.pages.settings_credits_checkout', [
            'userData' => $user,
            'purchaseType' => $purchaseType
        ]);
    }

    /**
     * settings Credits Checkout
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function settingsCreditsCheckout(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => ''
        ];

        $rules = array(
            'purchase_type_id' => 'required|string',
            'card_no' => 'required|string',
            'exp_month' => 'required|string',
            'exp_year' => 'required|string',
            'cvv' => 'required|string'
        );

        $messages = array(
            'purchase_type_id.required' => 'Purchase Type is required.',
            'card_no.required' => 'Credit Card Number field is required.',
            'exp_month.required' => 'Expiry Month field is required.',
            'exp_year.required' => 'Expiry Year field is required.',
            'cvv.required' => 'CVV field is required.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            $purchaseType = Buy_Credit::find($request->input('purchase_type_id'));
            $purchaseAmount = $purchaseType ? $purchaseType->price : 0;
            $creditsAmount = $purchaseType ? $purchaseType->xims_amount : 0;
            try {
                $stripe = Stripe::make(getenv('STRIPE_SECRET'));
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->has('card_no') ? $request->input('card_no') : '',
                        'exp_month' => $request->has('exp_month') ? $request->input('exp_month') : '',
                        'exp_year' => $request->has('exp_year') ? $request->input('exp_year') : '',
                        'cvc' => $request->has('cvc') ? $request->input('cvc') : ''
                    ],
                ]);
                if (!isset($token['id'])) {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'Can not create Stripe token.<br>';
                }
                if (!$responseData['has_error']) {
                    $chargeParams = [
                        'source' => $token['id'],
                        'currency' => 'USD',
                        'amount' => $purchaseAmount,
                        'description' => 'Charge - $' . $purchaseAmount . ' from ' . Auth::user()->email . ' (USER ID: ' . Auth::id() . ')',
                    ];
                    $charge = $stripe->charges()->create($chargeParams);
                    DB::table('stripe_charges')->insert([
                        'created_at' => Carbon::now(),
                        'data' => json_encode([
                            'token' => $token,
                            'charge_params' => $chargeParams,
                            'charge' => $charge,
                        ])
                    ]);
                    if($charge['status'] == 'succeeded') {
                        /**Write Here Your Database insert logic.*/
                        $id = Auth::id();
                        $userPurchase = new User_Purchase;
                        $userPurchase->user_id = $id;
                        $userPurchase->purchase_amount = $purchaseAmount;
                        $userPurchase->credits_amount = $creditsAmount;
                        $userPurchase->payment_id = $charge['id'];
                        $userPurchase->status = 0;
                        try {
                            if ($userPurchase->save()) {
                                $responseData['message'] = 'Successfully purchase. We are now processing the information. Your XIMs will be available shortly.';
                            } else {
                                $responseData['has_error'] = true;
                                $responseData['message'] .= 'An error occurred while saving data.' . '<br>';
                            }
                        } catch (\Exception $e) {
                            $responseData['has_error'] = true;
                            $responseData['message'] .= $e->getMessage() . '<br>';
                        }
                    } else {
                        $responseData['has_error'] = true;
                        $responseData['message'] .= 'Can not create Stripe charge.<br>';
                    }
                }
            } catch (Exception $e) {
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            }
        }
        return response()->json($responseData);
    }

    /**
     * Transaction History Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function transactionHistoryPage(Request $request) {
        $user = Auth::user();
        $userTransactions = $user->transactions()->get();
        if ($userTransactions->count()) {
            $byUsersIDS = [];
            $educationIDS = [];
            $certificationIDS = [];
            $resumeIDS = [];
            $meetupIDS = [];
            foreach($userTransactions as $transaction) {
                $byUsersIDS[] = $transaction->by_user_id;
                if ($transaction->education_id) {
                    $educationIDS[] = $transaction->education_id;
                }
                if ($transaction->certificate_id) {
                    if ($transaction->type == 'validation_resume') {
                        $resumeIDS[] = $transaction->certificate_id;
                    }else {
                        $certificationIDS[] = $transaction->certificate_id;
                    }
                }
                if ($transaction->type == 'meetup_inviting' || $transaction->type == 'meetup_accept' || $transaction->type == 'meetup_declined') {
                    $meetupIDS[] = $transaction->share_id;
                }
            }
            if (!empty($byUsersIDS)) {
                $byUsers = User::notDeleted()->whereIn('id', $byUsersIDS)->get();
                if ($byUsers->count()) {
                    $byUsers = $byUsers->keyBy('id');
                    foreach($userTransactions as $key => $transaction) {
                        if (isset($byUsers[$transaction->user_id])) {
                            $userTransactions[$key]->user = $byUsers[$transaction->user_id];
                        }
                    }
                }
            }
            if (!empty($certificationIDS)) {
                $certifications = User_certification::notDeleted()->whereIn('id', $certificationIDS)->get();
                if ($certifications->count()) {
                    $certifications = $certifications->keyBy('id');
                    foreach($userTransactions as $key => $transaction) {
                        if ($transaction->certificate_id && isset($certifications[$transaction->certificate_id])) {
                            $userTransactions[$key]->certificate = $certifications[$transaction->certificate_id];
                        }
                    }
                }
            }
            if (!empty($resumeIDS)) {
                $resumes = User_Resume::notDeleted()->whereIn('id', $resumeIDS)->get();
                if ($resumes->count()) {
                    $resumes = $resumes->keyBy('id');
                    foreach($userTransactions as $key => $transaction) {
                        if ($transaction->type == 'validation_resume' && $transaction->certificate_id && isset($resumes[$transaction->certificate_id])) {
                            $userTransactions[$key]->resume = $resumes[$transaction->certificate_id];
                        }
                    }
                }
            }
            if (!empty($educationIDS)) {
                $educations = User_Education::notDeleted()->whereIn('id', $educationIDS)->get();
                if ($educations->count()) {
                    $educations = $educations->keyBy('id');
                    foreach($userTransactions as $key => $transaction) {
                        if ($transaction->education_id && isset($educations[$transaction->education_id])) {
                            $userTransactions[$key]->education = $educations[$transaction->education_id];
                        }
                    }
                }
            }
            if (!empty($meetupIDS)) {
                $meetups = Meetup::notDeleted()->whereIn('id', $meetupIDS)->get();
                if ($meetups->count()) {
                    $meetups = $meetups->keyBy('id');
                    foreach($userTransactions as $key => $transaction) {
                        if ($transaction->type == 'meetup_inviting' && $transaction->share_id && isset($meetups[$transaction->share_id])) {
                            $userTransactions[$key]->meetup = $meetups[$transaction->share_id];
                        }
                        if ($transaction->type == 'meetup_accept' && $transaction->share_id && isset($meetups[$transaction->share_id])) {
                            $userTransactions[$key]->meetup = $meetups[$transaction->share_id];
                        }
                        if ($transaction->type == 'meetup_declined' && $transaction->share_id && isset($meetups[$transaction->share_id])) {
                            $userTransactions[$key]->meetup = $meetups[$transaction->share_id];
                        }
                    }
                }
            }
        } else {
            $userTransactions = null;
        }
        return view('frontend.pages.transaction_history', [
            'user' => $user,
            'userData' => $user,
            'userTransactions' => $userTransactions
        ]);
    }


    /**
     * save Geo Data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveGeo(Request $request) {
        $saved = false;
        $lat = $request->has('lat') ? round($request->input('lat'), 3) : '';
        $lon = $request->has('lon') ? round($request->input('lon'), 3) : '';
        $address = '';
        $user = Auth::user();
        if($lat && $lon) {
            // add check for user previous location distance
            if ($user && $user->location_title && $user->latitude && $user->longitude) {
                $distance = (6371 * acos(cos(deg2rad($user->latitude)) * cos(deg2rad($lat)) * cos(deg2rad($lon) - deg2rad($user->longitude)) + sin(deg2rad($user->latitude)) * sin(deg2rad($lat))));
                if ($distance <= 5) {
                    return response()->json(['saved' => $saved, 'user_address' => $user->location_title]);
                }
            }
            $locationExists = Location::where('latitude', $lat)->where('longitude', $lon)->first();
            if ($locationExists) {
                $address = $locationExists->city . ', ' . $locationExists->country;
            } else {
                try {
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?language=en&latlng=' . $lat . ',' . $lon . '&key=' . getenv('GOOGLE_API_KEY'));
                    $output = @json_decode($geocode);
                }catch (\Exception $e) {
                    $output = null;
                }
                if ($output && isset($output->results[0]->address_components) && !empty($output->results[0]->address_components)) {
                    $city = '';
                    $country = '';
                    $countryCode = '';
                    foreach($output->results[0]->address_components as $component) {
                        if (!$city && in_array('locality', $component->types)) {
                            $city = $component->short_name;
                        }
                        if (!$country && in_array('country', $component->types)) {
                            $country = $component->long_name;
                        }
                        if (!$countryCode && in_array('country', $component->types)) {
                            $countryCode = $component->short_name;
                        }
                    }
                    if (!$city) {
                        foreach($output->results[0]->address_components as $component) {
                            if (!$city && in_array('political', $component->types)) {
                                $city = $component->short_name;
                            }
                        }
                    }
                    $location = new Location;
                    $location->latitude = $lat;
                    $location->longitude = $lon;
                    $location->city = $city;
                    $location->country = $country;
                    $location->country_code = $countryCode;
                    $location->locaiton_data = json_encode($output->results[0]);
                    $location->save();
                    $address = $address = $location->city . ', ' . $location->country;
                }
            }
            $user = Auth::user();
            $user->location_title = $address ? $address : "(" . $lat . ", " . $lon . ")";
            $user->latitude = $lat;
            $user->longitude = $lon;
            $user->save();
            $saved = true;
        }
        return response()->json(['saved' => $saved, 'user_address' => $user->location_title]);
    }

    /**
     * save Share Data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveShare(Request $request) {
        $user = Auth::user();
        $user->share_count++;
        $user->save();
        return response()->json(['saved' => true, 'share_counts' => $user->share_count]);
    }

    /**
     * save user Push Notification Token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePushNotificationToken(Request $request) {
        $user = Auth::user();
        $saved = false;
        $token = $request->has('token') ? $request->input('token') : null;
        $tokens = $user->push_not_tokens;
        if (!$tokens) $tokens = [];
        if ($token && !in_array($token, $tokens)) {
            $tokens[] = $token;
            $user->push_not_tokens = $tokens;
            $user->save();
            $saved = true;
        }
        return response()->json(['saved' => $saved]);
    }

    /**
     * Phone Validation Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phoneValidationPage(Request $request) {
        $user = Auth::user();

        $session_start = Session::has('session_start') ? Session::get('session_start') : null;
        if (!$session_start || ($session_start && (Carbon::now()->timestamp - Carbon::parse($session_start)->timestamp) > 2 * 60)) {
            //return redirect(url('/logout?redirect=') . urlencode(url('/sign-up')));
        }
        $countries = Country::orderBy('country', 'asc')->get();
        //select current country start
        $lat = $user->latitude;
        $lon = $user->longitude;
        $countryCode = '';
        if ($lat && $lon) {
            $locationExists = Location::where('latitude', $lat)->where('longitude', $lon)->first();
            if ($locationExists) {
                $countryCode = $locationExists->country_code;
            } else {
                try {
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?language=en&latlng=' . $lat . ',' . $lon . '&key=' . getenv('GOOGLE_API_KEY'));
                    $output = @json_decode($geocode);
                }catch (\Exception $e) {
                    $output = null;
                }
                if ($output && isset($output->results[0]->address_components) && !empty($output->results[0]->address_components)) {
                    $city = '';
                    $country = '';
                    $countryCode = '';
                    foreach($output->results[0]->address_components as $component) {
                        if (!$city && in_array('locality', $component->types)) {
                            $city = $component->short_name;
                        }
                        if (!$country && in_array('country', $component->types)) {
                            $country = $component->long_name;
                        }
                        if (!$countryCode && in_array('country', $component->types)) {
                            $countryCode = $component->short_name;
                        }
                    }
                    if (!$city) {
                        foreach($output->results[0]->address_components as $component) {
                            if (!$city && in_array('political', $component->types)) {
                                $city = $component->short_name;
                            }
                        }
                    }
                    $location = new Location;
                    $location->latitude = $lat;
                    $location->longitude = $lon;
                    $location->city = $city;
                    $location->country = $country;
                    $location->country_code = $countryCode;
                    $location->locaiton_data = json_encode($output->results[0]);
                    $location->save();
                }
            }
        }
        $user->country_code = $countryCode;
        //select current country end
        return view('frontend.pages.phone-validation', [
            'countries' => $countries,
            'user' => $user
        ]);
    }

    /**
     * Phone Validation functionality
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phoneValidation(Request $request) {
        $responseData = [
            'has_error' => false,
            'message' => '',
            'redirect' => ''
        ];
        $fields = [];
        $fields['phone_number_country_code'] = $request->has('phone_number_country_code') ? trim($request->input('phone_number_country_code')) : '';
        $fields['phone_number'] = $request->has('phone_number') ? trim($request->input('phone_number')) : '';
        if (!$fields['phone_number']) {
            $responseData['has_error'] = true;
            $responseData['message'] = 'Please enter your mobile number.';
        } else if (!$this->validatePhoneNumber($fields['phone_number_country_code'] . ' ' . $fields['phone_number'])) {
            $responseData['has_error'] = true;
            $responseData['message'] = 'Invalid phone number.';
        }
        if (!$responseData['has_error']) {
            $user = Auth::user();
            if ($user) {
                $user->phone = $this->formatPhoneNumber($fields['phone_number_country_code'] . ' ' . $fields['phone_number']);
                $user->save();
                $responseData['message'] = 'Your mobile number successfully saved.';
                $responseData['redirect'] = url(getenv('BASE_LOGEDIN_PAGE'));
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] = 'Phone number cannot be saved, try again later.';
            }
        }
        return response()->json($responseData);
    }


    function formatPhoneNumber($phone) {
        $newPhone = $phone;
        try {
            $number = PhoneNumber::parse($phone, "CH");
            if ($number->isValidNumber()) {
                $newPhone = $number->format(PhoneNumberFormat::INTERNATIONAL);
            }
        }
        catch (PhoneNumberParseException $e) {
        }
        return $newPhone;
    }

    function validatePhoneNumber($phone) {
        $isValid = false;
        try {
            $number = PhoneNumber::parse($phone, "CH");

            if ($number->isValidNumber()) {
                $isValid = true;
            }
        }
        catch (PhoneNumberParseException $e) {
            // 'The string supplied is too short to be a phone number.'
        }
        return $isValid;

        /*
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace(["-", "(", ")"], "", $filtered_phone_number);
        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
            return true;
        }*/
    }

    /**
     * Meetup
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meetup(Request $request, $id = '') {
        $user = Auth::user();
        if (!$id) {
            $type = $request->has('type') ? trim($request->input('type')) : '';
            $id = $request->has('id') ? intval($request->input('id')) : 0;

            $responseData = [
                'has_error' => false,
                'message' => ''
            ];
            if (!$id || !$type) {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'An error occurred while checking meetup invite. Please try again later.<br>';
                return response()->json($responseData);
            } else {
                //get meetup based on id
                $meetup = Meetup::find($id);
                if (!$meetup) {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'Meetup data not founds. Please try again later.<br>';
                    return response()->json($responseData);
                } else if ($meetup && $meetup->status != 1) {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'This Meetup invitation already ' . ( $meetup->status == 2 ? 'accepted' : 'declined') . '.<br>';
                    $responseData['refresh_page'] = true;
                    return response()->json($responseData);
                }

                switch ($type) {
                    case "accept":
                        //update meetup
                        $meetup->status = 2; //accept
                        $meetup->invited_date = Carbon::now();
                        $result = $meetup->save();
                        if (!$result) {
                            $responseData['has_error'] = true;
                            $responseData['message'] .= 'An error occurred while accepting meetup. Please try again later.<br>';
                            return response()->json($responseData);
                        }
                        //send notifications to both users
                        $acceptNeededCredits = LAConfigs::getByKey('accepted_invite_xims_amount');
                        if (!$acceptNeededCredits) {
                            $acceptNeededCredits = 24;
                        }
                        //send notifications to inviting user
                        $userData = User::find($meetup->user_id_inviting);
                        if ($userData) {
                            Users_Notification::saveNotification('meetup_accepted', ($user && $user->phone ? $user->phone : '#'), $userData->id, $meetup->id);
                        }
                        //send notifications to invited user
                        Users_Notification::saveNotification('meetup_accepted', ($userData && $userData->phone ? $userData->phone : '#'), $user->id, $meetup->id);

                        //save transaction to invited user
                        $amount = $acceptNeededCredits;
                        $User_Transaction = new User_Transaction;
                        $User_Transaction->user_id = $user->id;
                        $User_Transaction->amount = $amount;
                        $User_Transaction->type = 'meetup_accept';
                        $User_Transaction->notes = 'You have received ' . $acceptNeededCredits . ' XIMs from ' . ($userData ? ($userData->name ? $userData->name : $userData->email) : '-') . ' for accepting his Meetup invitation.';
                        $User_Transaction->share_id = $meetup->id;

                        $User_Transaction->by_user_id = $user->id;
                        $User_Transaction->old_credits_amount = $user->credits_count_value;
                        $User_Transaction->new_credits_amount = floatval($user->credits_count_value) + $amount;
                        $User_Transaction->save();

                        //adding balance to invited user
                        $user->credits_count = $user->credits_count_value + $amount;
                        $user->save();
                        break;
                    case "decline":
                        //update meetup
                        $meetup->status = 3; //decline
                        $meetup->invited_date = Carbon::now();
                        $result = $meetup->save();
                        if (!$result) {
                            $responseData['has_error'] = true;
                            $responseData['message'] .= 'An error occurred while declining meetup. Please try again later.<br>';
                            return response()->json($responseData);
                        }


                        $userData = User::find($meetup->user_id_inviting);
                        if ($userData) {
                            //send notification to inviting user
                            $acceptNeededCredits = LAConfigs::getByKey('accepted_invite_xims_amount');
                            if (!$acceptNeededCredits) {
                                $acceptNeededCredits = 24;
                            }
                            Users_Notification::saveNotification('meetup_declined', $acceptNeededCredits, $userData->id, $meetup->id);

                            //save transaction to inviting user
                            $neededCredits = LAConfigs::getByKey('invite_xims_amount');
                            if (!$neededCredits) {
                                $neededCredits = 30;
                            }
                            $amount = $neededCredits;
                            $User_Transaction = new User_Transaction;
                            $User_Transaction->user_id = $userData->id;
                            $User_Transaction->amount = $amount;
                            $User_Transaction->type = 'meetup_declined';
                            $User_Transaction->notes = 'meetup_declined';
                            $User_Transaction->share_id = $meetup->id;

                            $User_Transaction->by_user_id = $userData->id;
                            $User_Transaction->old_credits_amount = $userData->credits_count_value;
                            $User_Transaction->new_credits_amount = floatval($userData->credits_count_value) + $amount;
                            $User_Transaction->save();

                            //adding balance to inviting user
                            $userData->credits_count = $userData->credits_count_value + $amount;
                            $userData->save();
                        }

                        break;
                    default:
                        break;
                }

            }
            return response()->json($responseData);
        }

        $userData = User::where('id', '=', $id)->first();

        $responseData = [
            'has_error' => false,
            'message' => ''
        ];
        if (!$userData) {
            $responseData['has_error'] = true;
            $responseData['message'] .= 'Invited user not found.<br>';
            return response()->json($responseData);
        }
        $meetup = $userData ? $userData->meetup() : null;
        if ($meetup && $meetup->status == 1) {
            $responseData['has_error'] = true;
            $responseData['message'] .= 'Meetup request already sent. Once your invite is accepted you can organize your meetup date.<br>';
            return response()->json($responseData);
        }
        $rules = array(
            'meetup_reason' => 'required|numeric',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $responseData['message'] .= 'Please, select meetup reason.<br>';
            return response()->json($responseData);
        }

        //check users balance and minus it
        $neededCredits = LAConfigs::getByKey('invite_xims_amount');
        if (!$neededCredits) {
            $neededCredits = 30;
        }
        if ($user->credits_count_value < $neededCredits) {
            $responseData['no_xims'] = true;
            //save notification
            Users_Notification::saveNotification('no_xims', 'You’re out of XIMs');
            return response()->json($responseData);
        } else {
            //save meetup
            $meetup = new Meetup;
            $meetup->unique_code = uniqid();
            $meetup->user_id_inviting = $user->id;
            $meetup->user_id_invited = $userData->id;
            $meetup->reason = $request->has('meetup_reason') ? trim($request->input('meetup_reason')) : '';
            $meetup->inviting_date = Carbon::now();
            $meetup->invited_date = null;
            $meetup->status = 1;
            $result = $meetup->save();

            if ($result) {
                $responseData['id'] = $result;
                //save notification to invited user
                $acceptNeededCredits = LAConfigs::getByKey('accepted_invite_xims_amount');
                if (!$acceptNeededCredits) {
                    $acceptNeededCredits = 24;
                }
                Users_Notification::saveNotification('meetup_wants', $acceptNeededCredits, $userData->id, $meetup->id);

                //save transaction to inviting user
                $amount = 0 - $neededCredits;
                $User_Transaction = new User_Transaction;
                $User_Transaction->user_id = $user->id;
                $User_Transaction->amount = $amount;
                $User_Transaction->type = 'meetup_inviting';
                $User_Transaction->notes = 'You have used ' . $neededCredits . 'XIMS for inviting ' . ($userData->name ? $userData->name : $userData->email) . ' to Meetup.';
                $User_Transaction->share_id = $meetup->id;

                $User_Transaction->by_user_id = $user->id;
                $User_Transaction->old_credits_amount = $user->credits_count_value;
                $User_Transaction->new_credits_amount = $user->credits_count_value + $amount;
                $User_Transaction->save();

                //minus balance to inviting user
                $user->credits_count = $user->credits_count_value + $amount;
                $user->save();
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] .= 'An error occurred while saving meetup data. Please try again later.<br>';
            }

        }


        return response()->json($responseData);
    }

    /**
     * Meetup Page
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meetupPage(Request $request, $id = '') {
        $user = Auth::user();
        $userData = User::where('id', '=', $id)->first();

        $reasons = Meetup_reason::where('status', '=', 1)->get();
        return view('frontend.pages.meetup', [
            'user' => $user,
            'userData' => $userData,
            'reasons' => $reasons,
        ]);
    }
}
