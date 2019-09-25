<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Artisan;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Homepage
     *
     * @return Response
     */
    public function index() {

        //updates meetup expires
        // cron example
        //* * * * * cd /var/www/html/laravelPath && php artisan schedule:run >> /dev/null 2>&1
        $exitCode = Artisan::call('meetups_expires', []);

        return view('home');
    }
}
