<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Users_Notification extends Model
{
    use SoftDeletes;

	protected $table = 'users_notifications';

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

    static function saveNotification($type = '', $notificationText = '', $userID = null, $referenceID = '')
    {
        if (!$type && !$notificationText) {
            return null;
        }
        $notification = new Users_Notification;
        $notification->user_id = $userID ? $userID : Auth::id();
        $notification->type = $type;
        $notification->notification_text = $notificationText;
        $notification->reference_id = $referenceID;
        $notification->save();
        return $notification;
    }

    // types
    //Not enough XIMs - no_xims
    //Education_Validation:_failure - education_validation_failure
    //Education_Validation:_success - education_validation_success
    //Certification_Validation:_failure - certificate_validation_failure
    //Certification_Validation:_success - certificate_validation_success
    //Resume_Validation:_success - resume_validation_success
    //Resume_Validation:_failure - resume_validation_failure
    //wants to meetup - meetup_wants
    //accepted your invite - meetup_accepted
    //declined your invite - meetup_declined
    //expired your invite - meetup_expired
    //XIM purchase complete - xim_purchase_complete
    //New jobs in your area - new_job
    //User verified - user_validation_success
    //Admins notifications from users notifications tool - admin_manual
    //App rating - app_rating
    //
    //Admins Added Notifications


}
