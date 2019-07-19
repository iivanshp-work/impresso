<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\User_certification;
use App\Models\User_Education;
use App\Models\User_Purchase;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\User_Transaction;

class User_TransactionsController extends Controller
{
	public $show_action = true;
	public $view_col = 'amount';
	public $listing_cols = ['id', 'user_id', 'amount', 'notes', 'type', 'by_user_id', 'purchase_id', 'share_id', 'education_id', 'certificate_id'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('User_Transactions', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('User_Transactions', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the User_Transactions.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('User_Transactions');
        $paginateLimit = 20;

		if(Module::hasAccess($module->id)) {
            $selectFields = $this->listing_cols;
            $selectFields[] = 'created_at';
            $query = DB::table('user_transactions')->select($selectFields)->whereNull('deleted_at');
            $params = [];
            $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
            $params['type'] = $request->has('type') ? intval($request->input('type')) : null;
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
                    $query->orWhere("notes", "like", "%" . $params['keyword'] . "%");
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
            if ($params['type'] !== null) {
                $query = $query->where("type", "=", $params['status']);
            }
            $selectedUser = null;
            if ($params['selected_user_id'] !== null) {
                $selectedUser = User::find($params['selected_user_id']);
                $query = $query->where("user_id", "=", $params['selected_user_id']);
            }

            $types = (new User_Transaction)->getTypes();

            $values = $query->orderBy("created_at", 'desc')->paginate($paginateLimit);

            if ($values) {
                $fields_popup = ModuleFields::getModuleFields('User_Transactions');
                for ($i = 0; $i < count($values); $i++) {
                    for ($j = 0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];
                        if ($col == 'type') {
                            $values[$i]->type_id = $values[$i]->type;
                            $values[$i]->$col = isset($types[$values[$i]->$col]) ? $types[$values[$i]->$col] : '';
                            continue;
                        }

                        if ($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            if ($col == 'user_id') {
                                $values[$i]->$col = $values[$i]->$col . ' - ' . ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                            } else {
                                $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);
                            }
                        }
                        if ($col == $this->view_col) {
                            $values[$i]->$col = '<a href="' . url(config('laraadmin.adminRoute') . '/user_transactions/' . $values[$i]->id) . ($params['selected_user_id'] ? '?selected_user_id=' . $params['selected_user_id'] : '') . '">' . $values[$i]->$col . '</a>';
                        }
                    }

                    if ($this->show_action) {
                        $output = '';
                        if (Module::hasAccess("User_Transactions", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_transactions.destroy', $values[$i]->id], 'method' => 'delete', 'style' => 'display:inline']);
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

            if ($selectedUser) {
                $fields = ['id', 'amount', 'type', 'notes'];
            } else {
                $fields = ['id', 'user_id', 'amount', 'type', 'notes'];
            }

			return View('la.user_transactions.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module,
                'values' => $values,
                'view_col' => $this->view_col,
                'selectedUser' => $selectedUser,
                'types' => $types,
                'fields' => $fields
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new user_transaction.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user_transaction in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("User_Transactions", "create")) {
		
			$rules = Module::validateRules("User_Transactions", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("User_Transactions", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.user_transactions.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified user_transaction.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("User_Transactions", "view")) {
			
			$user_transaction = User_Transaction::find($id);
			if(isset($user_transaction->id)) {
				$module = Module::get('User_Transactions');
                $types = (new User_Transaction)->getTypes();
                if ($user_transaction->by_user_id) {
                    $user_transaction->by_user = User::find($user_transaction->by_user_id);
                }
                if ($user_transaction->purchase_id) {
                    $user_transaction->purchase = User_Purchase::find($user_transaction->purchase_id);
                }
                if ($user_transaction->education_id) {
                    $user_transaction->education = User_Education::find($user_transaction->education_id);
                }
                if ($user_transaction->certificate_id) {
                    $user_transaction->certification = User_certification::find($user_transaction->certificate_id);
                }

                $user_transaction->type = isset($types[$user_transaction->type]) ? $types[$user_transaction->type] : '';
				$module->row = $user_transaction;
				
				return view('la.user_transactions.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('user_transaction', $user_transaction);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_transaction"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified user_transaction.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
        return redirect()->route(config('laraadmin.adminRoute') . '.user_transactions.index');
		if(Module::hasAccess("User_Transactions", "edit")) {			
			$user_transaction = User_Transaction::find($id);
			if(isset($user_transaction->id)) {	
				$module = Module::get('User_Transactions');
				
				$module->row = $user_transaction;
				
				return view('la.user_transactions.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('user_transaction', $user_transaction);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user_transaction"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified user_transaction in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
        return redirect()->route(config('laraadmin.adminRoute') . '.user_transactions.index');
		if(Module::hasAccess("User_Transactions", "edit")) {
			
			$rules = Module::validateRules("User_Transactions", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("User_Transactions", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.user_transactions.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}


    /**
     * Add Transaction Page
     * @param Request $request
     * @param $id
     */
    public function add_transaction_page(Request $request, $id = 0)
    {
        $userPurchase = User_Purchase::find($id);
        $authUser = Auth::user();
        $types = (new User_Transaction)->getTypes();
        $selected_user_id = $request->has('selected_user_id') ? intval($request->input('selected_user_id')) : null;

        /////purchase record
        // fields
        // user - readonly - auto
        // amount
        // type - disabled
        // notes - pre populated
        // date - auto
        // by user - auto
        // purchase id - auto from request

        ////add record
        /// type - other - disabled

        return view('la.user_transactions.add_page', [
            'user_purchase' => $userPurchase,
            'authUser' => $authUser,
            'types' => $authUser,
            'id' => $id
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function add_transaction_save(Request $request, $id = 0, $mode = '')
    {
        $user_purchase = User_Purchase::find($id);
        test($mode);
    }

	/**
	 * Remove the specified user_transaction from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("User_Transactions", "delete")) {
			User_Transaction::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.user_transactions.index');
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
		$values = DB::table('user_transactions')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('User_Transactions');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/user_transactions/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("User_Transactions", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/user_transactions/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("User_Transactions", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.user_transactions.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
