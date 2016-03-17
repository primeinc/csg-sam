<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Mfr.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Asset[] $assets
 * @property int $id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */
class Mfr extends Model
{
    use SoftDeletes, MfrAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the Assets for the Manufacturer.
     */
    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }

    /**
     * Get the Checkouts for the Manufacturer.
     */
    public function checkouts()
    {
        return $this->hasManyThrough('Checkout', 'Asset');
    }
}
