<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $usersCount = DB::table("users")->where("type", '=', '3')->whereNull('deleted_at')->count();
        $usersAdminCount = DB::table("users")->where("type", '=', '1')->whereNull('deleted_at')->count();
        $jobsCount = DB::table("jobs")->whereNull('deleted_at')->count();
        return view('la.dashboard',[
            'usersCount' => $usersCount,
            'usersAdminCount' => $usersAdminCount,
            'jobsCount' => $jobsCount,
        ]);
    }
}