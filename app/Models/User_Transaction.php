<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Transaction extends Model
{
    use SoftDeletes;
	
	protected $table = 'user_transactions';
	
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

    public function getAmountAttribute()
    {
        if ((int)$this->attributes['amount'] == $this->attributes['amount']) {
            return round($this->attributes['amount'],2);
        } else {
            return number_format($this->attributes['amount'],2, ',', '.');
        }
    }

    /**
     * Get Transactions types
     * @return array
     */
    public function getTypes() {
        return [
            'purchase' => 'Purchase',
            'user_validation' => 'User Validation Tokens',
            'share' => 'Share',
            'validation_education' => 'Education Validation',
            'validation_certificate' => 'Certificate Validation',
            'meetup_inviting' => 'Meetup Invitation',
            'meetup_accept' => 'Meetup Accept',
            'meetup_declined' => 'Meetup Rejection',
            'other' => 'Other',
        ];
    }
}
