<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Models\Users_Notification;
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

use App\Models\Job;
use App\Models\User;

class JobsController extends Controller
{
	public $show_action = true;
	public $view_col = 'job_title';
	public $listing_cols = ['id', 'job_title', 'company_title', 'location_title', 'status'];

	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Jobs', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Jobs', $this->listing_cols);
		}
	}

	/**
	 * Display a listing of the Jobs.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$module = Module::get('Jobs');
        $paginateLimit = getenv('PAGINATION_LIMIT');

		if(Module::hasAccess($module->id)) {
            $query = DB::table('jobs')->select($this->listing_cols)->whereNull('deleted_at');
            $params = [];
            $params['keyword'] = $request->has('keyword') ? trim($request->input('keyword')) : null;
            $params['status'] = $request->has('status') ? intval($request->input('status')) : null;

            if ($params['keyword']) {
                $query = $query->where(function ($query) use ($params) {
                    $query->orWhere("job_title", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("location_title", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("company_title", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("short_description", "like", "%" . $params['keyword'] . "%");
                    $query->orWhere("description", "like", "%" . $params['keyword'] . "%");
                });
            }
            if ($params['status'] !== null) {
                $query = $query->where("status", "=", $params['status']);
            }
            $values = $query->orderBy("id", 'desc')->paginate($paginateLimit);
            if($values){
                $fields_popup = ModuleFields::getModuleFields('Jobs');
                for($i=0; $i < count($values); $i++) {
                    for ($j=0; $j < count($this->listing_cols); $j++) {
                        $col = $this->listing_cols[$j];
                        if ($col == 'status') {
                            $values[$i]->$col = $values[$i]->$col ? "Active" : "Inactive";
                            continue;
                        }
                        if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                            $values[$i]->$col = ModuleFields::getFieldValue($fields_popup[$col], $values[$i]->$col);

                        }
                        if($col == $this->view_col) {
                            $values[$i]->$col = '<a href="'.url(config('laraadmin.adminRoute') . '/jobs/'.$values[$i]->id).'">'.$values[$i]->$col.'</a>';
                        }
                    }

                    if($this->show_action) {
                        $output = '';
                        if(Module::hasAccess("Jobs", "edit")) {
                            $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/jobs/'.$values[$i]->id.'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                        }

                        if(Module::hasAccess("Jobs", "delete")) {
                            $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jobs.destroy', $values[$i]->id], 'method' => 'delete', 'style'=>'display:inline', 'class'=>'custom-confirm']);
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

			return View('la.jobs.index', [
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
	 * Show the form for creating a new job.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created job in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Jobs", "create")) {

			$rules = Module::validateRules("Jobs", $request);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$insert_id = Module::insert("Jobs", $request);
            $job = Job::find($insert_id);
			$longitude = $request->has('longitude') && $request->input('longitude') ? $request->input('longitude') : '';
            $latitude = $request->has('latitude') && $request->input('latitude') ? $request->input('latitude') : '';
            $status = $request->has('status') && $request->input('status') ? 1 : 0;
            if ($longitude && $latitude && $status) {
                $radius = LAConfigs::getByKey('new_jobs_radius');
                if (!$radius) {
                    $radius = 100;
                }
                $users = User::notDeleted()
                    ->users()
                    ->notMe()
                    ->isWithinMaxDistance((object)['longitude' => $longitude, 'latitude' => $latitude], $radius)
                    ->get();
                if ($users->count()) {
                    foreach($users as $user) {
                        //save notification
                        Users_Notification::saveNotification('new_job', 'New jobs in your area!', $user->id, $job->id);
                    }
                }
            }

			return redirect()->route(config('laraadmin.adminRoute') . '.jobs.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified job.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Jobs", "view")) {

			$job = Job::find($id);
			if(isset($job->id)) {
				$module = Module::get('Jobs');
				$module->row = $job;

				return view('la.jobs.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('job', $job);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("job"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified job.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Jobs", "edit")) {
			$job = Job::find($id);
			if(isset($job->id)) {
				$module = Module::get('Jobs');

				$module->row = $job;

				return view('la.jobs.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('job', $job);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("job"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified job in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
        $job = Job::find($id);
		if(Module::hasAccess("Jobs", "edit")) {

			$rules = Module::validateRules("Jobs", $request, true);

			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}

			$insert_id = Module::updateRow("Jobs", $request, $id);

            $longitude = $request->has('longitude') && $request->input('longitude') ? $request->input('longitude') : '';
            $latitude = $request->has('latitude') && $request->input('latitude') ? $request->input('latitude') : '';
            $status = $request->has('status') && $request->input('status') ? 1 : 0;
            //TODO: not clear if this logic needed ???
            if ($longitude && $latitude && $status) {
                $radius = LAConfigs::getByKey('new_jobs_radius');
                if (!$radius) {
                    $radius = 100;
                }
                $users = User::notDeleted()
                    ->users()
                    ->notMe()
                    ->isWithinMaxDistance((object)['longitude' => $longitude, 'latitude' => $latitude], $radius)
                    ->get();
                if ($users->count()) {
                    $usersIDS = $users->keyBy('id');
                    $usersIDS = $usersIDS->keys()->toArray();
                    $existingNotifications = Users_Notification::notDeleted()
                        ->whereIn('user_id', $usersIDS)
                        ->where('type', '=', 'new_job')
                        ->where('reference_id', '=', $id)
                        ->get();
                    $existingNotificationsUserIDS = [];
                    if ($existingNotifications->count()) {
                        $existingNotificationsUserIDS = $existingNotifications->keyBy('user_id');
                        $existingNotificationsUserIDS = $existingNotificationsUserIDS->keys()->toArray();
                    }
                    foreach($users as $user) {
                        if (!in_array($user->id, $existingNotificationsUserIDS)) {
                            //save notification
                            Users_Notification::saveNotification('new_job', 'New jobs in your area!', $user->id, $job->id);
                        }
                    }
                }
            }

			return redirect()->route(config('laraadmin.adminRoute') . '.jobs.index');

		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified job from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Jobs", "delete")) {
			Job::find($id)->delete();

			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.jobs.index');
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
		$values = DB::table('jobs')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Jobs');

		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) {
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jobs/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}

			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Jobs", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/jobs/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}

				if(Module::hasAccess("Jobs", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jobs.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}

    public function getGeo(Request $request) {
        $saved = false;
        $address = $request->has('address') ? trim($request->input('address')) : '';
        $lat = $lon = null;
        if($address) {
            try {
                $details_url = 'https://maps.googleapis.com/maps/api/geocode/json?language=en&address=' . str_replace (" ", "+", $address) . '&key=' . getenv('GOOGLE_API_KEY');

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $details_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $geocode = curl_exec($ch);
                curl_close($ch);
                //$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?language=en&address=' . $address . '&key=' . getenv('GOOGLE_API_KEY'));
                $output = @json_decode($geocode);
            }catch (\Exception $e) {
                $output = $e->getMessage();
            }
            if ($output && isset($output->results[0]->geometry->location) && !empty($output->results[0]->geometry->location)) {
                $lat = $output->results[0]->geometry->location->lat;
                $lon = $output->results[0]->geometry->location->lng;
            }
        }
        return response()->json(['lat' => $lat, 'lon' => $lon]);
    }
}
