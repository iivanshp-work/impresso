<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Carbon;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Users_Notification;

class Users_NotificationsController extends Controller
{
	public $show_action = true;
	public $view_col = 'notification_text';
	public $listing_cols = ['id', 'type', 'notification_text'];
    public $adminType = 'admin_manual';

	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Users_Notifications', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Users_Notifications', $this->listing_cols);
		}
	}

	/**
	 * Display a listing of the Users_Notifications.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('Users_Notifications');
        $paginateLimit = getenv('PAGINATION_LIMIT');

		if(Module::hasAccess($module->id)) {
            $selectFields = $this->listing_cols;
            $selectFields[] = 'created_at';
            $query = DB::table('users_notifications')->select($selectFields)->whereNull('deleted_at')->where('type', $this->adminType);
            $params = [];
            $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
            $params['selected_user_id'] = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;
            $params['date_from'] = $request->has('date_from') ? trim($request->input('date_from')) : null;
            $params['date_to'] = $request->has('date_to') ? trim($request->input('date_to')) : null;
            if (!$params['selected_user_id']) {
                return redirect(config('laraadmin.adminRoute')."/users");
            }
            if ($params['keyword']) {
                $query = $query->where(function ($query) use ($params) {
                    $query->orWhere("notification_text", "like", "%" . $params['keyword'] . "%");
                });
            }
            if ($params['date_from']) {
                $query = $query->where("created_at", ">=", Carbon::parse($params['date_from'])->startOfDay());
            }
            if ($params['date_to']) {
                $query = $query->where("created_at", "<=", Carbon::parse($params['date_to'])->endOfDay());
            }
            $selectedUser = null;
            if ($params['selected_user_id'] !== null) {
                $selectedUser = User::find($params['selected_user_id']);
                $query = $query->where("user_id", "=", $params['selected_user_id']);
            }

            $values = $query->orderBy("created_at", 'desc')->paginate($paginateLimit);
            if ($values) {
                $fields_popup = ModuleFields::getModuleFields('Users_Notifications');
                for ($i = 0; $i < count($values); $i++) {
                    for ($j = 0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];

                        if ($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                        }
                        if ($col == $this->view_col) {
                            $values[$i]->$col = '<a href="' . url(config('laraadmin.adminRoute') . '/users_notifications/' . $values[$i]->id) . ($params['selected_user_id'] ? '?selected_user_id=' . $params['selected_user_id'] : '') . '">' . $values[$i]->$col . '</a>';
                        }
                    }

                    if ($this->show_action) {
                        $output = '';
                        if (Module::hasAccess("Users_Notifications", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.users_notifications.destroy', $values[$i]->id], 'method' => 'delete', 'style' => 'display:inline']);
                            $output .= ' <button title="Delete" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                            $output .= Form::close();
                        }
                        $values[$i]->actions = (string)$output;
                    }
                }
            }
            if ($values->count() == 0) {
                $values = 0;
            }
            $fields = ['id', 'notification_text'];
            return View('la.users_notifications.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module,
                'values' => $values,
                'view_col' => $this->view_col,
                'selectedUser' => $selectedUser,
                'fields' => $fields
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new users_notification.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created users_notification in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Users_Notifications", "create")) {

			$rules = Module::validateRules("Users_Notifications", $request);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$insert_id = Module::insert("Users_Notifications", $request);

			return redirect()->route(config('laraadmin.adminRoute') . '.users_notifications.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified users_notification.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Users_Notifications", "view")) {

			$users_notification = Users_Notification::find($id);
			if(isset($users_notification->id)) {
				$module = Module::get('Users_Notifications');
				$module->row = $users_notification;

				return view('la.users_notifications.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('users_notification', $users_notification);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("users_notification"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified users_notification.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Users_Notifications", "edit")) {
			$users_notification = Users_Notification::find($id);
			if(isset($users_notification->id)) {
				$module = Module::get('Users_Notifications');

				$module->row = $users_notification;

				return view('la.users_notifications.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('users_notification', $users_notification);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("users_notification"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified users_notification in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Users_Notifications", "edit")) {

			$rules = Module::validateRules("Users_Notifications", $request, true);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}

			$insert_id = Module::updateRow("Users_Notifications", $request, $id);

			return redirect()->route(config('laraadmin.adminRoute') . '.users_notifications.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified users_notification from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Users_Notifications", "delete")) {
			Users_Notification::find($id)->delete();
			// Redirecting to index() method
            return redirect(redirect()->getUrlGenerator()->previous());
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}


    /**
     * Add notification Page
     * @param Request $request
     * @param $id
     */
    public function add_notification_page(Request $request, $id = 0)
    {
        $authUser = Auth::user();
        $selected_user_id = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;
        $selectedUser = null;
        if ($selected_user_id) {
            $selectedUser = User::find($selected_user_id);
        }
        if (!$selectedUser) {
            return redirect(redirect()->getUrlGenerator()->previous());
        }

        return view('la.users_notifications.add_page', [
            'authUser' => $authUser,
            'purchase_id' => $id,
            'selectedUser' => $selectedUser
        ]);
    }
    /**
     * @param Request $request
     * @param $id
     */
    public function add_notification_save(Request $request)
    {
        $authUser = Auth::user();
        $selected_user_id = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;
        $selectedUser = null;
        if ($selected_user_id) {
            $selectedUser = User::find($selected_user_id);
        }
        if (!$selectedUser) {
            return redirect(config('laraadmin.adminRoute')."/users_notifications?selected_user_id=" . $selected_user_id);
        }
        //save notification
        $message = $request->has('notification_text') ? trim($request->input('notification_text')) : '';
        Users_Notification::saveNotification($this->adminType, $message, $selectedUser->id);
        return redirect(config('laraadmin.adminRoute')."/users_notifications?selected_user_id=" . $selected_user_id);
    }
}
