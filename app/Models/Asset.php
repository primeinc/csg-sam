<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mfr_id', 'part', 'description', 'msrp', 'filename', 'status'];

    /**
     * Get the Manufacturer that owns the asset.
     */
    public function mfr()
    {
        return $this->belongsTo('App\Models\Mfr');
    }

    /**
     * Get the Checkouts for an asset.
     */
    public function checkouts()
    {
        return $this->hasMany('App\Models\Checkout');
    }

}
