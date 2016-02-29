<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Dealer
 *
 * @property-read \App\Models\Access\User\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Checkout[] $checkouts
 * @property integer $id
 * @property integer $user_id
 * @property string $companyName
 * @property string $employeeName
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */
class Dealer extends Model
{
    use SoftDeletes;

    /**
     * Get the User assigned to the Dealer.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    /**
     * Get the checkouts for a Dealer.
     */
    public function checkouts()
    {
        return $this->hasMany('App\Models\Checkout');
    }
}
