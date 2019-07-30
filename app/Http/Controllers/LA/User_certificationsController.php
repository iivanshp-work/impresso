<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Validation_status;
use App\Models\Users_Notification;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\User_certification;

class User_certificationsController extends Controller
{
	public $show_action = true;
	public $view_col = 'title';
	public $listing_cols = ['id', 'title', 'status', 'user_id'];

	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('User_certifications', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('User_certifications', $this->listing_cols);
		}
	}

	/**
	 * Display a listing of the User_certifications.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('User_certifications');
        $paginateLimit = getenv('PAGINATION_LIMIT');

		if(Module::hasAccess($module->id)) {
            $query = DB::table('user_certifications')->select($this->listing_cols)->whereNull('deleted_at');
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
            if ($values) {
                $fields_popup = ModuleFields::getModuleFields('User_certifications');
                for ($i = 0; $i < count($values); $i++) {
                    for ($j = 0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];

                        if ($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                        }
                        if ($col == $this->view_col) {
                            $values[$i]->$col = '<a href="' . url(config('laraadmin.adminRoute') . '/user_certifications/' . $values[$i]->id) . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '') . '">' . $values[$i]->$col . '</a>';
                        }
                    }

                    if ($this->show_action) {
                        $output = '';
                        if (Module::hasAccess("User_certifications", "edit")) {
                            $output .= '<a href="' . url(config('laraadmin.adminRoute') . '/user_certifications/' . $values[$i]->id . '/edit' . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '')) . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                        }

                        if (Module::hasAccess("User_certifications", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_certifications.destroy', $values[$i]->id], 'method' => 'delete', 'style' => 'display:inline']);
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
            $statuses = Validation_status::all()->pluck('title', 'id');

			return View('la.user_certifications.index', [
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

	/**
	 * Show the form for creating a new user_certification.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user_certification in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("User_certifications", "create")) {

			$rules = Module::validateRules("User_certifications", $request);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$insert_id = Module::insert("User_certifications", $request);

			return redirect()->route(config('laraadmin.adminRoute') . '.user_certifications.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified user_certification.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("User_certifications", "view")) {

			$user_certification = User_certification::find($id);
			if(isset($user_certification->id)) {
				$module = Module::get('User_certifications');
				$module->row = $user_certification;
                if ($user_certification->user_id) {
                    $user_certification->user = User::find($user_certification->user_id);
                }

				return view('la.user_certifications.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding",
                    'user_certification' => $user_certification

				])->with('user_certification', $user_certification);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_certification"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified user_certification.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("User_certifications", "edit")) {
			$user_certification = User_certification::find($id);
			if(isset($user_certification->id)) {
				$module = Module::get('User_certifications');

				$module->row = $user_certification;
                if ($user_certification->user_id) {
                    $user_certification->user = User::find($user_certification->user_id);
                }

				return view('la.user_certifications.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
                    'user_certification' => $user_certification

				])->with('user_certification', $user_certification);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_certification"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified user_certification in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
        $user_certification = User_certification::find($id);
		if(Module::hasAccess("User_certifications", "edit")) {

			$rules = Module::validateRules("User_certifications", $request, true);

			$validator = Validator::make($request->all(), $rules);
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
            $insert_id = Module::updateRow("User_certifications", $request, $id);

			if ($user_certification && $request->has('status') && $request->input('status') == 3) {
                //save notification
                $message = 'Certificate Validation: success';
                Users_Notification::saveNotification('certificate_validation_success', $message, $user_certification->user_id, $user_certification->id);
                $user = $user_certification->user_id ? User::find($user_certification->user_id) : null;
                if ($user) {
                    $user->sendPushNotifications($message);
                }
            }
			if ($user_certification && $request->has('status') && $request->input('status') == 4) {
                //save notification
                $message = 'Certificate Validation: failure';
                Users_Notification::saveNotification('certificate_validation_failure', $message, $user_certification->user_id, $user_certification->id);
                $user = $user_certification->user_id ? User::find($user_certification->user_id) : null;
                if ($user) {
                    $user->sendPushNotifications($message);
                }
            }
            $selected_user_id = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;
            if ($selected_user_id) {
                return redirect(config('laraadmin.adminRoute') . "/user_certifications?selected_user_id=" . $selected_user_id);
            } else {
                return redirect()->route(config('laraadmin.adminRoute') . '.user_certifications.index');
            }

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified user_certification from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("User_certifications", "delete")) {
			User_certification::find($id)->delete();

			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.user_certifications.index');
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
		$values = DB::table('user_certifications')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('User_certifications');

		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) {
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/user_certifications/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}

			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("User_certifications", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/user_certifications/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}

				if(Module::hasAccess("User_certifications", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_certifications.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
