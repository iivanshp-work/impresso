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
    use SoftDeletes;

	protected $table = 'users';

	protected $hidden = [

    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

    /**
     * @param $query
     * @param $location
     * @return mixed
     */
    public function scopeWithDistance($query, $location) {
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
        return 0; // TODO????????
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
    public function getHasNewNotificationsAttribute()
    {
        if ($this->notif_view_date) {
            $notifications = $this->notifications()->where('created_at', '>', Carbon::parse($this->notif_view_date))->get();
        } else {
            $notifications = $this->notifications()->get();
        }
        return $notifications->count() ? 1 : 0;
    }

}
