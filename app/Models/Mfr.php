<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mfr extends Model
{

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
