<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Checkout
 *
 * @property-read \App\Models\Asset $asset
 * @property-read \App\Models\Access\User\User $user
 * @property-read \App\Models\Dealer $dealer
 * @property integer $id
 * @property integer $asset_id
 * @property integer $user_id
 * @property integer $dealer_id
 * @property string $notes
 * @property string $expectedReturnDate
 * @property string $returnedDate
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */
class Checkout extends Model
{
    use SoftDeletes;

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
        return $this->belongsTo('App\Models\Access\User\User');
    }

    /**
     * Get the Dealer assigned who has the asset.
     */
    public function dealer()
    {
        return $this->belongsTo('App\Models\Dealer');
    }
}
