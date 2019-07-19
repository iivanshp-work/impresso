<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\User_Purchase;

class User_PurchasesController extends Controller
{
	public $show_action = true;
	public $view_col = 'purchase_amount';
	public $listing_cols = ['id', 'user_id', 'purchase_amount', 'payment_id', 'status'];

	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('User_Purchases', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('User_Purchases', $this->listing_cols);
		}
	}

	/**
	 * Display a listing of the User_Purchases.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('User_Purchases');
        $paginateLimit = 20;

		if(Module::hasAccess($module->id)) {
		    $selectFields = $this->listing_cols;
            $selectFields[] = 'created_at';
            $query = DB::table('user_purchases')->select($selectFields)->whereNull('deleted_at');
            $params = [];
            $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
            $params['status'] = $request->has('status') ? intval($request->input('status')) : null;
            $params['selected_user_id'] = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;
            $params['date_from'] = $request->has('date_from') ? trim($request->input('date_from')) : null;
            $params['date_to'] = $request->has('date_to') ? trim($request->input('date_to')) : null;

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
                    $query->orWhere("payment_id", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("amount", "=", $params['keyword']);
                    if (!empty($userIDS)) {
                        $query->orWhereIn("user_id", $userIDS);
                    }
                });
            }
            if ($params['date_from']) {
                $query = $query->where("created_at", ">=", Carbon::parse($params['date_from'])->startOfDay());
            }
            if ($params['date_to']) {
                $query = $query->where("created_at", "<=", Carbon::parse($params['date_to'])->endOfDay());
            }
            if ($params['status'] !== null) {
                $query = $query->where("status", "=", $params['status']);
            }
            $selectedUser = null;
            if ($params['selected_user_id'] !== null) {
                $selectedUser = User::find($params['selected_user_id']);
                $query = $query->where("user_id", "=", $params['selected_user_id']);
            }

            $statuses = (new User_Purchase)->getStatuses();

            $values = $query->orderBy("created_at", 'desc')->paginate($paginateLimit);
            if ($values) {
                $fields_popup = ModuleFields::getModuleFields('User_Purchases');
                for ($i = 0; $i < count($values); $i++) {
                    for ($j = 0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];
                        if ($col == 'status') {
                            $values[$i]->status_id = $values[$i]->status;
                            $values[$i]->$col = isset($statuses[$values[$i]->$col]) ? $statuses[$values[$i]->$col] : '';
                            continue;
                        } else if ($col == "purchase_amount") {
                            $values[$i]->$col = '$' . $values[$i]->$col;
                        }

                        if ($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            if($col == 'user_id') {
                                $values[$i]->$col = $values[$i]->$col . ' - ' .ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                            } else {
                                $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                            }
                        }
                        if ($col == $this->view_col) {
                            $values[$i]->$col = '<a href="' . url(config('laraadmin.adminRoute') . '/user_purchases/' . $values[$i]->id) . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '') . '">' . $values[$i]->$col . '</a>';
                        }
                    }

                    if ($this->show_action) {
                        $output = '';
                        if (Module::hasAccess("User_Transactions", "edit") && $values[$i]->status_id == 0) {
                            $output .= '<a title="Create Editing Transaction" href="' . url(config('laraadmin.adminRoute') . '/user_transactions/add/' . $values[$i]->id . '' . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '')) . '" class="btn btn-warning btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i>&nbsp;<i class="fa fa-money"></i>&nbsp;Editing</a>';
                            $output .= '<a title="Create Automatic Transaction" href="' . url(config('laraadmin.adminRoute') . '/user_transactions/add/' . $values[$i]->id . '/automatic' . ($params['selected_user_id'] ? '?selected_user_id='.$params['selected_user_id'] : '')) . '" class="btn btn-success btn-xs margin-r-5" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-adn"></i>&nbsp;<i class="fa fa-money"></i>&nbsp;Auto</a>';
                        }
                        if (Module::hasAccess("User_Purchases", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_purchases.destroy', $values[$i]->id], 'method' => 'delete', 'style' => 'display:inline']);
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

            return View('la.user_purchases.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => $this->listing_cols,
                'module' => $module,
                'values' => $values,
                'view_col' => $this->view_col,
                'selectedUser' => $selectedUser,
                'statuses' => $statuses
            ]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new user_purchase.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user_purchase in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        return redirect()->route(config('laraadmin.adminRoute') . '.user_purchases.index');
		/*if(Module::hasAccess("User_Purchases", "create")) {

			$rules = Module::validateRules("User_Purchases", $request);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$insert_id = Module::insert("User_Purchases", $request);

			return redirect()->route(config('laraadmin.adminRoute') . '.user_purchases.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}*/
	}

	/**
	 * Display the specified user_purchase.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("User_Purchases", "view")) {

			$user_purchase = User_Purchase::find($id);
			if(isset($user_purchase->id)) {
                $statuses = (new User_Purchase)->getStatuses();
                $user_purchase->purchase_amount = '$' . $user_purchase->purchase_amount;
                $user_purchase->status = $statuses[$user_purchase->status];
				$module = Module::get('User_Purchases');
				$module->row = $user_purchase;

				return view('la.user_purchases.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('user_purchase', $user_purchase);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_purchase"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified user_purchase.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
        return redirect()->route(config('laraadmin.adminRoute') . '.user_purchases.index');
		/*if(Module::hasAccess("User_Purchases", "edit")) {
			$user_purchase = User_Purchase::find($id);
			if(isset($user_purchase->id)) {
				$module = Module::get('User_Purchases');

				$module->row = $user_purchase;

				return view('la.user_purchases.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('user_purchase', $user_purchase);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_purchase"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}*/
	}

	/**
	 * Update the specified user_purchase in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("User_Purchases", "edit")) {

			$rules = Module::validateRules("User_Purchases", $request, true);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}

			$insert_id = Module::updateRow("User_Purchases", $request, $id);

			return redirect()->route(config('laraadmin.adminRoute') . '.user_purchases.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified user_purchase from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("User_Purchases", "delete")) {
			User_Purchase::find($id)->delete();

			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.user_purchases.index');
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
		$values = DB::table('user_purchases')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('User_Purchases');

		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) {
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/user_purchases/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}

			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("User_Purchases", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/user_purchases/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}

				if(Module::hasAccess("User_Purchases", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_purchases.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
