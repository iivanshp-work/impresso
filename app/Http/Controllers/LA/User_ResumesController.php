<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\User_Transaction;
use App\Models\Users_Notification;
use App\Models\Validation_status;
use Dwij\Laraadmin\Models\LAConfigs;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\User_Resume;

class User_ResumesController extends Controller
{
	public $show_action = true;
	public $view_col = 'title';
    public $listing_cols = ['id', 'user_id', 'title', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('User_Resumes', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('User_Resumes', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the User_Resumes.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {
        $module = Module::get('User_Resumes');
        $paginateLimit = getenv('PAGINATION_LIMIT');

        if(Module::hasAccess($module->id)) {
            $query = DB::table('user_resumes')->select($this->listing_cols)->whereNull('deleted_at');
            $params = [];
            $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
            $params['status'] = $request->has('status') ? intval($request->input('status')) : null;
            $params['selected_user_id'] = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;

            if ($params['keyword']) {
                $users = DB::table('users')->select('id')->whereNull('deleted_at')->where(function ($query) use ($params) {
                    $query->orWhere("name", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("email", "like", "%" . $params['keyword'] . "%");
                })->where('type', '=', getenv('USERS_TYPE_USER'))->get();
                $userIDS = [];
                if ($users) {
                    foreach($users as $user) {
                        $userIDS[] = $user->id;
                    }
                    $userIDS = array_unique($userIDS);
                }
                $query = $query->where(function ($query) use ($params, $userIDS) {
                    $query->orWhere("title", "like", "%" . $params['keyword'] . "%");
                    if (!empty($userIDS)) {
                        $query->orWhereIn("user_id", $userIDS);
                    }
                });
            }
            if ($params['status'] !== null) {
                $query = $query->where("status", "=", $params['status']);
            }
            $selectedUser = null;
            if ($params['selected_user_id'] !== null) {
                $selectedUser = User::find($params['selected_user_id']);
                $query = $query->where("user_id", "=", $params['selected_user_id']);
            }
            $values = $query->orderBy("created_at", 'desc')->paginate($paginateLimit);
            $statuses = [
                1 => 'New - not verified',
                2 => 'Request verification',
                3 => 'Verified',
                4 => 'Verification failed',
            ];
            if ($values) {
                $fields_popup = ModuleFields::getModuleFields('User_Resumes');
                for ($i = 0; $i < count($values); $i++) {
                    for ($j = 0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];

                        if ($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            if ($col == 'status') {
                                $values[$i]->$col = isset($statuses[$values[$i]->$col]) ? $statuses[$values[$i]->$col] : '';
                            }else if ($col == 'user_id') {
                                $userValue = $values[$i]->$col . ' - ' . ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                                $values[$i]->$col = '<a class="black_link" href="' . url(config('laraadmin.adminRoute') . '/users/' . $values[$i]->$col . '/edit') . '">' . $userValue . '</a>';
                            } else {
                                $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                            }
                        }
                        if ($col == $this->view_col) {
                            $values[$i]->$col = '<a href="' . url(config('laraadmin.adminRoute') . '/user_cesumes/' . $values[$i]->id) . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '') . '">' . $values[$i]->$col . '</a>';
                        }
                    }

                    if ($this->show_action) {
                        $output = '';
                        if (Module::hasAccess("User_Resumes", "edit")) {
                            $output .= '<a href="' . url(config('laraadmin.adminRoute') . '/user_resumes/' . $values[$i]->id . '/edit' . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '')) . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                        }

                        if (Module::hasAccess("User_Resumes", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_resumes.destroy', $values[$i]->id], 'method' => 'delete', 'style' => 'display:inline', 'class'=>'custom-confirm']);
                            $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                            $output .= Form::close();
                        }
                        $values[$i]->actions = (string)$output;
                    }
                }
            }
            if ($values->count() == 0) {
                $values = 0;
            }
            return View('la.user_resumes.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => $this->listing_cols,
                'module' => $module,
                'statuses' => $statuses,
                'values' => $values,
                'statuses' => $statuses,
                'view_col' => $this->view_col,
                'selectedUser' => $selectedUser
            ]);
        } else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
    }
	/*
	public function index()
	{
		$module = Module::get('User_Resumes');
		
		if(Module::hasAccess($module->id)) {
			return View('la.user_resumes.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}*/

	/**
	 * Show the form for creating a new user_resume.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user_resume in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("User_Resumes", "create")) {
		
			$rules = Module::validateRules("User_Resumes", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("User_Resumes", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.user_resumes.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified user_resume.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("User_Resumes", "view")) {
			
			$user_resume = User_Resume::find($id);
			if(isset($user_resume->id)) {
				$module = Module::get('User_Resumes');
				$module->row = $user_resume;
                if ($user_resume->user_id) {
                    $user_resume->user = User::find($user_resume->user_id);
                }
				return view('la.user_resumes.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding",
                    'user_resume' => $user_resume
				])->with('user_resume', $user_resume);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_resume"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified user_resume.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("User_Resumes", "edit")) {			
			$user_resume = User_Resume::find($id);
			if(isset($user_resume->id)) {	
				$module = Module::get('User_Resumes');
				
				$module->row = $user_resume;
                if ($user_resume->user_id) {
                    $user_resume->user = User::find($user_resume->user_id);
                }
                $statuses = [
                    1 => 'New - not verified',
                    2 => 'Request verification',
                    3 => 'Verified',
                    4 => 'Verification failed',
                ];
				return view('la.user_resumes.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
                    'user_resume' => $user_resume,
                    'statuses' => $statuses
				])->with('user_resume', $user_resume);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_resume"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified user_resume in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
        $user_resume = User_Resume::find($id);
		if(Module::hasAccess("User_Resumes", "edit")) {
			
			$rules = Module::validateRules("User_Resumes", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("User_Resumes", $request, $id);

            if ($user_resume && $request->has('status') && $request->input('status') == 3) {
                //save notification
                $message = 'Resume/CV Verification: success';
                Users_Notification::saveNotification('resume_validation_success', $message, $user_resume->user_id, $user_resume->id);
                $user = $user_resume->user_id ? User::find($user_resume->user_id) : null;
                if ($user) {
                    $user->sendPushNotifications($message);
                }
                // add users 30 XIMS to user
                //save in transcations
                $neededCredits = LAConfigs::getByKey('validation_value');
                if (!$neededCredits) {
                    $neededCredits = 30;
                }
                $amount = $neededCredits;
                $User_Transaction = new User_Transaction;
                $User_Transaction->user_id = $user->id;
                $User_Transaction->amount = $amount;
                $User_Transaction->type = 'validation_resume';
                $User_Transaction->notes = 'CV/Resume Verification "' . $user_resume->title . '" - #' . $user_resume->id;
                $User_Transaction->certificate_id = $user_resume->id;

                $User_Transaction->by_user_id = Auth::id();
                $User_Transaction->old_credits_amount = $user->credits_count_value;
                $User_Transaction->new_credits_amount = $user->credits_count_value + $amount;
                $User_Transaction->save();

                //adjust user credits amount
                $user->credits_count = $user->credits_count_value + $amount;
                $user->save();
            }
            if ($user_resume && $request->has('status') && $request->input('status') == 4) {
                //save notification
                $message = 'Resume/CV Validation: failure';
                Users_Notification::saveNotification('resume_validation_failure', $message, $user_resume->user_id, $user_resume->id);
                $user = $user_resume->user_id ? User::find($user_resume->user_id) : null;
                if ($user) {
                    $user->sendPushNotifications($message);
                }
            }
            $selected_user_id = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;
            if ($selected_user_id) {
                return redirect(config('laraadmin.adminRoute') . "/user_resumes?selected_user_id=" . $selected_user_id);
            } else {
                return redirect()->route(config('laraadmin.adminRoute') . '.user_resumes.index');
            }

			
			return redirect()->route(config('laraadmin.adminRoute') . '.user_resumes.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified user_resume from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("User_Resumes", "delete")) {
			User_Resume::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.user_resumes.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('user_resumes')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('User_Resumes');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/user_resumes/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("User_Resumes", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/user_resumes/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("User_Resumes", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_resumes.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
