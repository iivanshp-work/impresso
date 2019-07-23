<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User_certification;
use App\Models\User_Education;
use App\Models\User_Purchase;
use App\Models\Users_Notification;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Controllers\LA\UploadsController as UploadsController;

class NotificationsController extends Controller
{
    /**
     * SignController constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->middleware('auth');
        $this->middleware('redirects');
    }

    /**
     * Profile Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notificationsPage(Request $request) {
        $user = Auth::user();
        $notifications = [];
        $generalNotifications = Notification::notDeleted()->active()->orderBy('created_at', 'desc')->get();
        if ($generalNotifications) {
            $generalNotifications = $generalNotifications->toArray();
            $notifications = array_merge($notifications, $generalNotifications);
        }
        $userNotifications = $user->notifications()->get();
        if ($userNotifications) {
            $userNotifications = $userNotifications->toArray();
            $notifications = array_merge($notifications, $userNotifications);
        }
        $notifications = collect($notifications);
        $notifications = $notifications->sortByDesc('created_at');
        test($notifications);
        //Carbon::now()->diffForHumans(['options' => Carbon::ONE_DAY_WORDS])
        test($generalNotifications);
        return view('frontend.pages.notifications', [
            'user' => $user,
            'notifications' => $notifications
        ]);
    }
}
