<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use App\Models\Meetup;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Auth;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    // use SoftDeletes;
    use EntrustUserTrait;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "role", "provider", "provider_id", "type", "photo"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $dates = ['deleted_at'];

    protected $casts = [
        'push_not_tokens' => 'array',
    ];

    /**
     * @return mixed
     */
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }

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
        return $query->where('type', '=', 3); // 3 - Users, 1 - Admins
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
    public function notifications()
    {
        return $this->hasMany('App\Models\Users_Notification')->notDeleted()->orderBy('created_at', 'desc');
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

}
