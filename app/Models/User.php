<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

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
        $haversine = "(6371 * acos(cos(radians({$location->latitude})) 
                     * cos(radians({$table}.latitude)) 
                     * cos(radians({$table}.longitude) 
                     - radians({$location->longitude})) 
                     + sin(radians({$location->latitude})) 
                     * sin(radians({$table}.latitude))))";
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

}
