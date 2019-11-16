<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Model
{
    //use SoftDeletes; //TODO: CHECK CLIENT

	protected $table = 'users';

	protected $hidden = [

    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

    protected $casts = [
        'push_not_tokens' => 'array',
    ];

    /**
     * @param $query
     * @param $location
     * @return mixed
     */
    public function scopeWithDistance($query, $location) {
        $location->longitude = floatval($location->longitude);
        $location->latitude = floatval($location->latitude);
        $table = $this->getTable();

        if ($location->longitude && $location->latitude) {
            $haversine = "(6371 * acos(cos(radians({$location->latitude})) 
                     * cos(radians({$table}.latitude)) 
                     * cos(radians({$table}.longitude) 
                     - radians({$location->longitude})) 
                     + sin(radians({$location->latitude})) 
                     * sin(radians({$table}.latitude))))";
        } else {
            $haversine = 1000000;
        }
        return $query
            ->select() //pick the columns you want here.
            ->selectRaw("{$haversine} AS distance");
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotMe($query) {
        $id = Auth::id();
        return $query->where('id', '<>', $id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUsers($query) {
        return $query->where('type', '=', getenv('USERS_TYPE_USER')); // 3 - Users, 1 - Admins
    }

    /**
     * @param $query
     * @param $location
     * @param int $radius
     * @return mixed
     */
    public function scopeIsWithinMaxDistance($query, $location, $radius = 25) {
        $location->longitude = floatval($location->longitude);
        $location->latitude = floatval($location->latitude);
        $table = $this->getTable();
        $haversine = "(6371 * acos(cos(radians({$location->latitude})) 
                     * cos(radians({$table}.latitude)) 
                     * cos(radians({$table}.longitude) 
                     - radians({$location->longitude})) 
                     + sin(radians({$location->latitude})) 
                     * sin(radians({$table}.latitude))))";
        return $query
            ->select() //pick the columns you want here.
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius]);
    }

    /**
     * @return mixed
     */
    public function getCreditsCountAttribute()
    {
        if ((int)$this->attributes['credits_count'] == $this->attributes['credits_count']) {
            return round($this->attributes['credits_count'],2);
        } else {
            return number_format($this->attributes['credits_count'],2, ',', '.');
        }
    }

    public function getCreditsCountValueAttribute()
    {
        return round($this->attributes['credits_count'],2);
    }

    /**
     * @return mixed
     */
    public function getMeetupCountAttribute()
    {
        return $this->calculateMeetupCount($this->id);
    }

    /**
     * Calculate Meetup Count
     * @param $id
     * @return mixed
     */
    public function calculateMeetupCount($id) {
        $count = $this->meetups()->where('status', 2)->count();// accepted meetups
        return $count;
    }

    /**
     * @return mixed
     */
    public function educations()
    {
        return $this->hasMany('App\Models\User_Education')->notDeleted();
    }

    /**
     * @return mixed
     */
    public function educations_verified()
    {
        return $this->hasMany('App\Models\User_Education')->notDeleted()->verified();
    }

    /**
     * @return mixed
     */
    public function certifications()
    {
        return $this->hasMany('App\Models\User_certification')->notDeleted();
    }

    /**
     * @return mixed
     */
    public function certifications_verified()
    {
        return $this->hasMany('App\Models\User_certification')->notDeleted()->verified();
    }

    /**
     * @return mixed
     */
    public function resumes()
    {
        return $this->hasMany('App\Models\User_Resume')->notDeleted();
    }

    /**
     * @return mixed
     */
    public function resumes_verified()
    {
        return $this->hasMany('App\Models\User_Resume')->notDeleted()->verified();
    }

    /**
     * @return mixed
     */
    public function purchases()
    {
        return $this->hasMany('App\Models\User_Purchase')->notDeleted()->orderBy('created_at', 'desc');
    }

    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\User_Transaction')->notDeleted()->orderBy('created_at', 'desc');
    }

    /**
     * @return mixed
     */
    public function meetups()
    {
        $id = $this->id;
        return Meetup::notDeleted()
            ->where(function ($query) use ($id) {
                $query->orWhere(function ($query2) use ($id) {
                    $query2->where("user_id_invited", "=", $id);
                });
                $query->orWhere(function ($query2) use ($id) {
                    $query2->where("user_id_inviting", "=", $id);
                });
            })
            ->orderBy('created_at', 'desc');
    }

    public function lastMeetup()
    {
        $id = $this->id;
        return Meetup::notDeleted()
            ->where(function ($query) use ($id) {
                $query->orWhere(function ($query2) use ($id) {
                    $query2->where("user_id_invited", "=", $id);
                });
                $query->orWhere(function ($query2) use ($id) {
                    $query2->where("user_id_inviting", "=", $id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function meetup($id = null)
    {
        if (!$id) $id = $this->id;
        if (!$id) return null;
        return Meetup::notDeleted()
            ->where(function ($query) use ($id) {
                $query->orWhere(function ($query2) use ($id) {
                    $query2->where("user_id_inviting", "=", Auth::id());
                    $query2->where("user_id_invited", "=", $id);
                });
                $query->orWhere(function ($query2) use ($id) {
                    $query2->where("user_id_inviting", "=", $id);
                    $query2->where("user_id_invited", "=", Auth::id());
                });
            })
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * @return mixed
     */
    public function getHasNewNotificationsAttribute()
    {
        if ($this->notif_view_date) {
            $notifications = $this->notifications()->where('created_at', '>', Carbon::parse($this->notif_view_date))->get();
            $notificationsGeneral = Notification::notDeleted()->where('created_at', '>', Carbon::parse($this->notif_view_date))->where('status', '=', 1)->get();
        } else {
            $notifications = $this->notifications()->get();
            $notificationsGeneral = Notification::notDeleted()->where('created_at', '>', Carbon::parse($this->created_at))->where('status', '=', 1)->get();
        }
        return $notifications->count() || $notificationsGeneral->count() ? 1 : 0;
    }

    /**
     * send Push Notifications to user
     * @param string $message
     * @return array
     */
    public function sendPushNotifications($message = '')
    {
        $clientTokenIDs = $this->push_not_tokens;

        if (!empty($clientTokenIDs) && $message) {
            $responses = [];
            $url = getenv('PUSH_NOTIFICATION_URL');
            $YOUR_API_KEY = getenv('PUSH_NOTIFICATION_API_KEY'); // Server key
            foreach($clientTokenIDs as $clientTokenID) {
                $YOUR_TOKEN_ID = $clientTokenID; // Client token id
                $request_body = [
                    'to' => $YOUR_TOKEN_ID,
                    'notification' => [
                        'title' => getenv('PUSH_NOTIFICATION_TITLE'),
                        'body' => $message,
                        'icon' => asset('img/Logo.png?width=192&height=192')
                    ],
                ];
                $fields = json_encode($request_body);
                $request_headers = [
                    'Content-Type: application/json',
                    'Authorization: key=' . $YOUR_API_KEY,
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $responses[$clientTokenID] = $response;
            }
        } else {
            $responses = [];
        }
        return $responses;
    }

    /**
     * check User Daily Xims
     * @param $request
     * @return string
     */
    public function checkUserDailyXims($request) {
        if ($this->id && $this->is_verified && !$request->has('show_daily_xims_popup')) {
            if ($this->daily_xims_date == "0000-00-00 00:00:00") {
                $this->daily_xims_date = null;
            }
            //check last daily Xims date
            //check last daily Xims date
            if ((!$this->daily_xims_date && Carbon::parse($this->created_at)->startOfDay()->timestamp < Carbon::now()->startOfDay()->timestamp) || ($this->daily_xims_date && Carbon::parse($this->daily_xims_date)->startOfDay()->timestamp < Carbon::now()->startOfDay()->timestamp)) {
                //save notification
                //Users_Notification::saveNotification('daily_xims', '', $this->id);

                //add credits to User
                $neededCredits = LAConfigs::getByKey('daily_xims_amount');
                if (!$neededCredits) {
                    $neededCredits = 10;
                }
                $amount = $neededCredits;
                $User_Transaction = new User_Transaction;
                $User_Transaction->user_id = $this->id;
                $User_Transaction->amount = $amount;
                $User_Transaction->type = 'daily_xims';
                $User_Transaction->notes = 'Daily Xims';

                $User_Transaction->by_user_id = $this->id;
                $User_Transaction->old_credits_amount = $this->credits_count_value;
                $User_Transaction->new_credits_amount = floatval($this->credits_count_value) + $amount;
                $User_Transaction->save();

                //adding balance to user
                $this->credits_count = $this->credits_count_value + $amount;
                //update last daily Xims date
                $this->daily_xims_date = Carbon::now();
                $this->save();
                //redirect user with param to show daily Xims popup
                $redirectUrl = $request->getPathInfo() . (empty($request->query()) ? '?' : '&') . 'show_daily_xims_popup=1';
                return $redirectUrl;
            }
        }
        return '';
    }

    /**
     * Add UUID To Users
     */
    public function AddUUIDToUsers(){
        $users = $this::all();
        foreach($users as $user) {
            if(!$user->uuid) {
                $user->uuid = str_random(20);
                $user->save();
            }
        }
    }

}
