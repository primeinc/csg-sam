<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Dealer.
 *
 * @mixin \Eloquent
 */
class Dealership extends Model
{
    use SoftDeletes, DealershipAttribute;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function dealers()
    {
        return $this->hasMany('App\Models\Dealer');
    }
}
