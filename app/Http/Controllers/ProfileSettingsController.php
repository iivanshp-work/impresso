<?php

namespace App\Http\Controllers;

use App\Models\User_certification;
use App\Models\User_Education;
use App\User;
use App\Models\User as UserModel;
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
            test($request->all());
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
            if ($user->credits_count < getenv('VERIFIED_DOCUMENT_CREDITS_AMOUNT')) {
                $responseData['no_xims'] = true;
                return response()->json($responseData);
            } else {
                //update users xims
                //save in transcations
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
            } else {
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
            $responseData['id'] = $data->id;
            return response()->json($responseData);
        }

        $rules = array(
            'name' => 'required|string', // make sure the name is an actual string
            'company_title' => 'required|string', // company_title can only be alphanumeric
            'job_title' => 'required|string', // company_title can only be alphanumeric,
            'impress' => 'required|string', // impress can only be alphanumeric
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            $topSkills = $request->has('top_skills') ? implode("\n", $request->input('top_skills')) : '';
            $softSkills = $request->has('soft_skills') ? implode("\n", $request->input('soft_skills')) : '';
            $id = Auth::id();
            $user = UserModel::find($id);
            $user->photo = $request->has('photo') ? intval($request->input('photo')) : 0;
            $user->name = $request->has('name') ? trim($request->input('name')) : '';
            $user->company_title = $request->has('company_title') ? trim($request->input('company_title')) : '';
            $user->job_title = $request->has('job_title') ? trim($request->input('job_title')) : '';
            $user->university_title = $request->has('university_title') ? trim($request->input('university_title')) : '';
            $user->certificate_title = $request->has('certificate_title') ? trim($request->input('certificate_title')) : '';
            $user->impress = $request->has('impress') ? trim($request->input('impress')) : '';
            $user->top_skills = $topSkills;
            $user->soft_skills = $softSkills;
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
                        }
                    }
                }
            }

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
                        }
                    }
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
            'email' => 'required|email',
            'phone' => 'regex:/^[0-9\-]{5,15}$/'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $responseData['has_error'] = true;
            $messages = $validator->errors();
            foreach ($messages->all() as $message) {
                $responseData['message'] .= $message . '<br>';
            }
        } else {
            $id = Auth::id();
            $user = UserModel::find($id);
            $user->full_name_birth = $request->has('full_name_birth') ? trim($request->input('full_name_birth')) : '';
            $user->email = $request->has('email') ? trim($request->input('email')) : '';
            $user->phone = $request->has('phone') ? trim($request->input('phone')) : '';
            $user->address = $request->has('address') ? trim($request->input('address')) : '';
            $user->address2 = $request->has('address2') ? trim($request->input('address2')) : '';
            $user->city = $request->has('city') ? trim($request->input('city')) : '';
            try {
                if ($user->save()) {
                    $responseData['message'] = 'Personal data successfully saved.';
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
}
