<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meetup extends Model
{
    use SoftDeletes;

	protected $table = 'meetups';

	protected $hidden = [

    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * @return mixed
     */
    public function invitingUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id_inviting', 'id')->notDeleted();
    }

    /**
     * @return mixed
     */
    public function invitedUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id_invited', 'id')->notDeleted();
    }

    /**
     * @return mixed
     */
    public function meetupReason()
    {
        return $this->belongsTo('App\Models\Meetup_reason', 'reason', 'id');
    }

    /**
     * @return mixed
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            '1' => 'Processing',
            '2' => 'Accept',
            '3' => 'Declined',
            '4' => 'Expired'
        ];
        //status:: 1 - processing, 2 - success, 3 - fail, 4 expired

        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }
}
