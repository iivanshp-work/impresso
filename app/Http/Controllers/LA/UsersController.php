<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\User_Transaction;
use Carbon\Carbon;
use Dwij\Laraadmin\Models\LAConfigs;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\User;

class UsersController extends Controller
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name', 'email', 'is_verified', 'varification_pending'];

	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Users', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Users', $this->listing_cols);
		}
	}

	/**
	 * Display a listing of the Users.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('Users');
        $mode = $request->path() == "admin/administrators" ? "admins" : "users";
        $paginateLimit = 20;
        $this->listing_cols[] = 'created_at';
        $this->listing_cols[] = 'credits_count';
        $query = DB::table('users')->select($this->listing_cols)->whereNull('deleted_at')->where('type', '=', ($mode == "admins" ? getenv('USERS_TYPE_ADMIN') : getenv('USERS_TYPE_USER')));
        $params = [];
        $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
        $params['status'] = $request->has('status') ? intval($request->input('status')) : null;
        $params['date_from'] = $request->has('date_from') ? trim($request->input('date_from')) : null;
        $params['date_to'] = $request->has('date_to') ? trim($request->input('date_to')) : null;

        if ($params['keyword']) {
            $query = $query->where(function ($query) use ($params) {
                $query->orWhere("name", "like", "%" . $params['keyword'] . "%");
                $query->orWhere("email", "like", "%" . $params['keyword'] . "%");
            });
        }
        if ($params['date_from']) {
            $query = $query->where("created_at", ">=", Carbon::parse($params['date_from'])->startOfDay());
        }
        if ($params['date_to']) {
            $query = $query->where("created_at", "<=", Carbon::parse($params['date_to'])->endOfDay());
        }
        if ($params['status'] !== null) {
            if($params['status'] == 1) {
                $query = $query->where("is_verified", "=", 1);
            } else if($params['status'] == 2) {
                $query = $query->where("varification_pending", "=", 1);
            } else if($params['status'] == 3) {
                $query = $query->where("is_verified", "=", 0)->where("varification_pending", "=", 0);
            }
        }
        $values = $query->orderBy("id", 'desc')->paginate($paginateLimit);
        if($values){
            $fields_popup = ModuleFields::getModuleFields('Users');
            for($i=0; $i < count($values); $i++) {
                for ($j=0; $j < count($this->listing_cols); $j++) {
                    $col = $this->listing_cols[$j];
                    if ($col == 'created_at') continue;
                    if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                        $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);

                    }
                    if($col == $this->view_col) {
                        $values[$i]->$col = '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$values[$i]->id).'">'.$values[$i]->$col.'</a>';
                    }
                }

                if($this->show_action) {
                    $user = User::find($values[$i]->id);
                    $output = '';
                    if(Module::hasAccess("Users", "edit")) {
                        $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$values[$i]->id.'/edit').'" class="btn btn-warning btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                    }

                    if(Module::hasAccess("Users", "delete")) {
                        $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.users.destroy', $values[$i]->id], 'method' => 'delete', 'style'=>'display:inline']);
                        $output .= ' <button class="btn btn-danger btn-xs margin-r-5" type="submit"><i class="fa fa-times"></i></button>';
                        $output .= Form::close();
                    }


                    if ($user && $user->educations()->count()) {
                        $output .= '<a title="Educations" href="'.url(config('laraadmin.adminRoute') . '/user_educations?selected_user_id=' . $values[$i]->id).'" class="btn btn-bitbucket btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-archive"></i></a>';
                    }

                    if ($user && $user->certifications()->count()) {
                        $output .= '<a title="Certifications" href="'.url(config('laraadmin.adminRoute') . '/user_certifications?selected_user_id=' . $values[$i]->id).'" class="btn btn-primary btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-certificate"></i></a>';
                    }

                    if ($user && $user->purchases()->count()) {
                        $output .= '<a title="Purchases" href="'.url(config('laraadmin.adminRoute') . '/user_purchases?selected_user_id=' . $values[$i]->id).'" class="btn btn-pinterest btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-cc-stripe"></i></a>';
                    }

                    if ($user && $user->transactions()->count()) {
                        $output .= '<a title="Transactions" href="'.url(config('laraadmin.adminRoute') . '/user_transactions?selected_user_id=' . $values[$i]->id).'" class="btn btn-success btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-money"></i></a>';
                    }
                    $values[$i]->actions = (string)$output;
                }
            }
        }
        if($values->count() == 0){
            $values = 0;
        }
        if ($mode == "admins") {
            $fields = ['id', 'name', 'email'];
        } else {
            $fields = ['id', 'name', 'email', 'status', 'credits_count', 'created_at'];
        }

		if(Module::hasAccess($module->id)) {
			return View('la.users.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
                'view_col' => $this->view_col,
				'module' => $module,
                'mode' => $mode,
                'values' => $values,
                'fields' => $fields
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Users", "create")) {

			$rules = Module::validateRules("Users", $request);
            $mode = $request->has('type') && $request->input('type') == getenv('USERS_TYPE_ADMIN') ? 'admins' : 'users';
			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$insert_id = Module::insert("Users", $request);

            if ($mode == "admins") {
                return redirect(config('laraadmin.adminRoute')."/administrators");
            } else {
                return redirect()->route(config('laraadmin.adminRoute') . '.users.index');
            }

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Users", "view")) {

			$user = User::find($id);
            $mode = $user && $user->type == getenv('USERS_TYPE_ADMIN') ? 'admins' : 'users';
			if(isset($user->id)) {
				$module = Module::get('Users');
				$module->row = $user;

				return view('la.users.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding",
                    'user' => $user,
                    'mode' => $mode
				])->with('user', $user);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Users", "edit")) {
			$user = User::find($id);
            $mode = $user && $user->type == getenv('USERS_TYPE_ADMIN') ? 'admins' : 'users';
			if(isset($user->id)) {
				$module = Module::get('Users');

				$module->row = $user;

				return view('la.users.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
                    'user' => $user,
                    'mode' => $mode
				])->with('user', $user);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Users", "edit")) {
		    $user = User::find($id);
            $mode = $user && $user->type == getenv('USERS_TYPE_ADMIN') ? 'admins' : 'users';

            if (!$request->input('password') && isset($request->all()['password'])){
                $request->request->remove('password');
            }
			$rules = Module::validateRules("Users", $request, true);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}

			$status = intval($request->input('status'));
			if ($status == 1) {
			    $request->request->add(['is_verified' => 'is_verified']);
            } else if ($status == 2) {
                $request->request->add(['varification_pending' => 'varification_pending']);
                $request->request->add(['is_verified_hidden' => 'false']);
            } else if ($status == 3) {
                $request->request->add(['is_verified_hidden' => 'false']);
                $request->request->add(['varification_pending_hidden' => 'false']);
            }
            $addCredits = false;
			if (!$user->added_init_credits && !$user->is_verified && $status == 1){
			    $addCredits = true;
            }
			if ($addCredits) {
                $request->request->add(['added_init_credits' => 1]);
            }
			$insert_id = Module::updateRow("Users", $request, $id);
            if ($addCredits) {
                $neededCredits = LAConfigs::getByKey('validation_value');
                if (!$neededCredits) {
                    $neededCredits = 30;
                }
                $amount = $neededCredits;
                $User_Transaction = new User_Transaction;
                $User_Transaction->user_id = $user->id;
                $User_Transaction->amount = $amount;
                $User_Transaction->type = 'user_validation';
                $User_Transaction->notes = 'Tokens which every user receives to start with.';
                $User_Transaction->by_user_id = $user->id;
                $User_Transaction->old_credits_amount = $user->credits_count;
                $User_Transaction->new_credits_amount = $user->credits_count + $amount;
                $User_Transaction->save();

                //adjust user credits amount
                $user = User::find($id);
                $user->credits_count = $user->credits_count + $amount;
                $user->save();
            }
			if ($mode == "admins") {
                return redirect(config('laraadmin.adminRoute')."/administrators");
            } else {
                return redirect()->route(config('laraadmin.adminRoute') . '.users.index');
            }

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Users", "delete")) {
			$user = User::find($id);
            $mode = $user && $user->type == getenv('USERS_TYPE_ADMIN') ? 'admins' : 'users';
            $user->delete();

			// Redirecting to index() method
            if ($mode == "admins") {
                return redirect(config('laraadmin.adminRoute')."/administrators");
            } else {
                return redirect()->route(config('laraadmin.adminRoute') . '.users.index');
            }
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
		$values = DB::table('users')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Users');

		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) {
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}

			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Users", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}

				if(Module::hasAccess("Users", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.users.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
