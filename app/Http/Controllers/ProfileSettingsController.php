<?php

namespace App\Http\Controllers;

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
            $uploadController = new UploadsController();
            $responseImage = $uploadController->upload_files(true, null, ["width" => 200, "height" => 200]);
            if ($responseImage["status"] == "success") {
                $responseData['image'] = $responseImage["upload"];
                $responseData['id'] = $responseImage["upload"]->id;;
            } else {
                $responseData['has_error'] = true;
                $responseData['message'] = 'An error occurred while submited photo. Please try again later.';
            }
            return $responseData;
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
            try {
                if ($user->save()) {
                    $responseData['message'] = 'Success';
                } else {
                    $responseData['has_error'] = true;
                    $responseData['message'] .= 'An error occurred while saving data.' . '<br>';
                }
            }catch(\Exception $e){
                $responseData['has_error'] = true;
                $responseData['message'] .= $e->getMessage() . '<br>';
            }
        }
        return response()->json($responseData);
    }
}
