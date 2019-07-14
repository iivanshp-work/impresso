<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
	
	protected $table = 'jobs';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

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
     * @param $lat
     * @param $lng
     * @param $distance
     * @param string $distanceIn
     * @return mixed
     */
    public static function getNearBy($lat, $lng, $distance, $distanceIn = 'miles')
    {
        if ($distanceIn == 'km') {
            $results = self::select(['*', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(lat) ) ) ) AS distance')])->havingRaw('distance < '.$distance)->get();
        } else {
            $results = self::select(['*', DB::raw('( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(lat) ) ) ) AS distance')])->havingRaw('distance < '.$distance)->get();
        }
        return $results;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }
}
