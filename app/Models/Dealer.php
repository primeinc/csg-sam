<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    /**
     * Get the User assigned to the Dealer.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the checkouts for a Dealer.
     */
    public function checkouts()
    {
        return $this->hasMany('App\Models\Checkout');
    }
}
