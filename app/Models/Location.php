<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Location
 *
 * @mixin \Eloquent
 */
class Location extends Model
{
    use SoftDeletes;

    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }
}
