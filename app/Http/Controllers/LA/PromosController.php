<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Promo;

class PromosController extends Controller
{
	public $show_action = true;
	public $view_col = 'title';
	public $listing_cols = ['id', 'title', 'tags', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Promos', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Promos', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Promos.
     * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('Promos');
        $paginateLimit = getenv('PAGINATION_LIMIT');

		if(Module::hasAccess($module->id)) {
		    $query = DB::table('promos')->select($this->listing_cols)->whereNull('deleted_at');
            $params = [];
            $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
            $params['status'] = $request->has('status') ? intval($request->input('status')) : null;

            if ($params['keyword']) {
                $query = $query->where(function ($query) use ($params) {
                    $query->orWhere("title", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("tags", "like", "%" . $params['keyword'] . "%");
                });
            }
            if ($params['status'] !== null) {
                $query = $query->where("status", "=", $params['status']);
            }
            $values = $query->orderBy("id", 'desc')->paginate($paginateLimit);
            if($values){
                $fields_popup = ModuleFields::getModuleFields('Promos');
                for($i=0; $i < count($values); $i++) {
                    for ($j=0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];
                        if ($col == 'status') {
                            $values[$i]->$col = $values[$i]->$col ? "Active" : "Inactive";
                            continue;
                        }
                        if ($col == 'tags') {
                            $valueOut = '';
                            if ($values[$i]->$col) {
                                $valueSel = json_decode($values[$i]->$col, 1);
                                if ($valueSel) {
                                    foreach ($valueSel as $key => $val) {
                                        $valueOut .= "<a href='".url(config("laraadmin.adminRoute")."/promos?keyword=" . $val)."' class='label label-primary'>" . $val . "</a> ";
                                    }
                                }
                            }
                            $values[$i]->$col = $valueOut;
                            continue;
                        }
                        if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);

                        }
                        if($col == $this->view_col) {
                            $values[$i]->$col = '<a href="'.url(config('laraadmin.adminRoute') . '/promos/'.$values[$i]->id).'">'.$values[$i]->$col.'</a>';
                        }
                    }

                    if($this->show_action) {
                        $output = '';
                        if(Module::hasAccess("Promos", "edit")) {
                            $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/promos/'.$values[$i]->id.'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                        }

                        if(Module::hasAccess("Promos", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.promos.destroy', $values[$i]->id], 'method' => 'delete', 'style'=>'display:inline', 'class'=>'custom-confirm']);
                            $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                            $output .= Form::close();
                        }
                        $values[$i]->actions = (string)$output;
                    }
                }
            }
            if($values->count() == 0){
                $values = 0;
            }

            return View('la.promos.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => $this->listing_cols,
                'view_col' => $this->view_col,
                'module' => $module,
                'values' => $values
            ]);

		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new promo.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created promo in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Promos", "create")) {
		
			$rules = Module::validateRules("Promos", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Promos", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.promos.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified promo.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Promos", "view")) {
			
			$promo = Promo::find($id);
			if(isset($promo->id)) {
				$module = Module::get('Promos');
				$module->row = $promo;
				
				return view('la.promos.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('promo', $promo);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("promo"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified promo.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Promos", "edit")) {			
			$promo = Promo::find($id);
			if(isset($promo->id)) {	
				$module = Module::get('Promos');
				
				$module->row = $promo;
				
				return view('la.promos.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('promo', $promo);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("promo"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified promo in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Promos", "edit")) {
			
			$rules = Module::validateRules("Promos", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Promos", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.promos.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified promo from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Promos", "delete")) {
			Promo::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.promos.index');
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
		$values = DB::table('promos')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Promos');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/promos/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Promos", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/promos/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Promos", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.promos.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
