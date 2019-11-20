<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Upload;
use App\User;
use Illuminate\Http\Request;

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
        //$this->middleware('guest');
    }

    /**
     * Homepage
     *
     * @return Response
     */
    public function index() {

        //uploads update path
        $uploads = Upload::all();
        if ($uploads) {
            foreach ($uploads as $upload) {
                $upload->path = str_replace('/home/xobaedic/www/valididentity.ch', $_SERVER['DOCUMENT_ROOT'], $upload->path);
                test($upload->path);
                $upload->save();
            }
        }
        //users update images for facebook and linkedin providers
        test("Exit");
        $users = User::where('provider', 'facebook')->get();
        if ($users) {
            foreach($users as $user) {
                $photo = 0;
                $fbId = $user->provider_id;
                if ($fbId) {
                    $image = 'https://graph.facebook.com/v2.9/' . $fbId . '/picture?type=normal';

                    try {
                        $image = str_replace('?type=normal', 'jpg', $image);
                        $uploadController = new UploadsController;
                        $responseImage = $uploadController->upload_files(true, $image, ["width" => 200, "height" => 200], true);
                        if ($responseImage["status"] == "success") {
                            $photo = $responseImage["upload"]->id;
                        }
                    }catch (Exception $exception) {
                    }
                    //https://graph.facebook.com/v2.9/2513685432246252/picture?type=normal
                }
                $user->photo = $photo;
                $user->save();
            }
        }
        test($users);
        //manual for linkedin
        return view('home');
    }

    /**
     * maintenance mode page
     *
     * @return Response
     */
    public function maintenancePage() {
        return view('frontend.pages.maintenance');
    }
}
