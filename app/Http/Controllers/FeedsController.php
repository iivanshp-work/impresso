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
    private $paginationLimit = 2;

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

        $jobs = Job::withDistance($userData)->notDeleted()->where('status', '=', 1)->orderBy('distance')->limit($this->paginationLimit)->get();
        if ($jobs->count() == 0) $jobs = null;
        $professionals = User::withDistance($userData)->notDeleted()->users()->notMe()->orderBy('distance')->limit($this->paginationLimit)->get();//->where('is_verified', '1')
        if ($professionals->count() == 0) $professionals = null;

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
            'has_more' => false,
            'html' => '',
            'page' => 1,
            'keyword' => '',
        ];
        $userData = Auth::user();

        $type = $request->has('type') ? $request->input('type') : '';
        $keyword = $request->has('keyword') ? trim($request->input('keyword')) : '';
        $page = $request->has('page') ? intval($request->input('page')) : 1;
        $offset = ($page - 1) * $this->paginationLimit;

        switch ($type) {
            case 'jobs':
                $jobs = Job::withDistance($userData)
                    ->notDeleted()
                    ->where('status', '=', 1)
                    ->where(function ($query) use ($keyword) {
                        $query->orWhere("job_title", "like", "%" . $keyword . "%");
                        $query->orWhere("company_title", "like", "%" . $keyword . "%");
                        $query->orWhere("short_description", "like", "%" . $keyword . "%");
                        $query->orWhere("description", "like", "%" . $keyword . "%");
                        $query->orWhere("location_title", "like", "%" . $keyword . "%");
                    })
                    ->orderBy('distance')
                    ->offset($offset)
                    ->limit($this->paginationLimit)
                    ->get();
                if ($jobs->count() == 0) $jobs = null;
                $html = view('frontend.pages.includes.feeds_jobs_items', [
                    'jobs' => $jobs,
                ])->render();
                $responseData['html'] = $html;
                $responseData['has_more'] = $html ? true : false;
                $responseData['page'] = $page;
                $responseData['keyword'] = $keyword;
                break;

            case 'professionals':
                $professionals = User::withDistance($userData)
                    ->notDeleted()
                    ->users()
                    ->notMe()
                    //->where('is_verified', '1')
                    ->where(function ($query) use ($keyword) {
                        $query->orWhere("name", "like", "%" . $keyword . "%");
                        $query->orWhere("email", "like", "%" . $keyword . "%");
                        $query->orWhere("job_title", "like", "%" . $keyword . "%");
                        $query->orWhere("company_title", "like", "%" . $keyword . "%");
                        $query->orWhere("location_title", "like", "%" . $keyword . "%");
                        $query->orWhere("top_skills", "like", "%" . $keyword . "%");
                        $query->orWhere("soft_skills", "like", "%" . $keyword . "%");
                        $query->orWhere("impress", "like", "%" . $keyword . "%");
                    })
                    ->orderBy('distance')
                    ->offset($offset)
                    ->limit($this->paginationLimit)
                    ->get();
                if ($professionals->count() == 0) $professionals = null;
                $html = view('frontend.pages.includes.feeds_professionals_items', [
                    'professionals' => $professionals,
                ])->render();
                $responseData['html'] = $html;
                $responseData['has_more'] = $html ? true : false;
                $responseData['page'] = $page;
                $responseData['keyword'] = $keyword;
                break;

            default:
                break;
        }
        return response()->json($responseData);
    }
}
