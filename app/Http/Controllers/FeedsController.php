<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class FeedsController extends Controller
{
    private $paginationLimit = 5;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * initial feeds listing
     *
     */
    public function feeds() {
        $jobs = Job::where('job_title', '<>', '')->limit($this->paginationLimit)->get();
        $professionals = User::where('is_verified', '0')->limit($this->paginationLimit)->get();
        return view('frontend.pages.feeds', [
            'jobs' => $jobs,
            'professionals' => $professionals
        ]);
    }
}
