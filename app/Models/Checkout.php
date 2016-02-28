<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{

    /**
     * Get the Asset checked out.
     */
    public function asset()
    {
        return $this->belongsTo('App\Models\Asset');
    }

    /**
     * Get the User that checked out the asset.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the Dealer assigned who has the asset.
     */
    public function dealer()
    {
        return $this->belongsTo('App\Models\Dealer');
    }
}
