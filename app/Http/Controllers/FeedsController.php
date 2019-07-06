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
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedsPage() {
        $userData = Auth::user();
        $jobs = Job::where('status', '=', 1)->withDistance($userData)->limit($this->paginationLimit)->orderBy('distance')->get();
        $professionals = User::where('is_verified', '0')->limit($this->paginationLimit)->get();
        return view('frontend.pages.feeds', [
            'jobs' => $jobs,
            'professionals' => $professionals
        ]);
    }

    /**
     * feeds functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feeds(Request $request) {
        $responseData = [
            'has_error' => '',
            'records' => null,
            'has_records' => false
        ];
        return response()->json($responseData);
    }
}
