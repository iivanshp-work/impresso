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
        $usersCount = DB::table("users")->where("type", '=', getenv('USERS_TYPE_USER'))->whereNull('deleted_at')->count();
        $usersPendingCount = DB::table("users")->where("type", '=', getenv('USERS_TYPE_USER'))->whereNull('deleted_at')->where("is_verified", "=", 0)->where("varification_pending", "=", 1)->count();
        $usersAdminCount = DB::table("users")->where("type", '=', getenv('USERS_TYPE_ADMIN'))->whereNull('deleted_at')->count();
        $jobsCount = DB::table("jobs")->whereNull('deleted_at')->count();
        $promosCount = DB::table("promos")->whereNull('deleted_at')->count();
        $educationCount = DB::table("user_educations")->where("status", '=', 2)->whereNull('deleted_at')->count();
        $certificationCount = DB::table("user_certifications")->where("status", '=', 2)->whereNull('deleted_at')->count();
        $purchasesCount = DB::table("user_purchases")->where("status", '=', 0)->whereNull('deleted_at')->count();

        return view('la.dashboard',[
            'usersCount' => $usersCount,
            'usersPendingCount' => $usersPendingCount,
            'usersAdminCount' => $usersAdminCount,
            'educationCount' => $educationCount,
            'certificationCount' => $certificationCount,
            'purchasesCount' => $purchasesCount,
            'jobsCount' => $jobsCount,
            'promosCount' => $promosCount,
        ]);
    }
}
