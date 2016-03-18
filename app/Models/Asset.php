<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Asset.
 *
 * @property-read \App\Models\Mfr $mfr
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Checkout[] $checkouts
 * @property int $id
 * @property int $mfr_id
 * @property string $part
 * @property string $description
 * @property float $msrp
 * @property string $image
 * @property bool $status
 * @property string $statusNotes
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */
class Asset extends Model
{
    use SoftDeletes;

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
    protected $fillable = ['mfr_id', 'location_id', 'part', 'description', 'msrp', 'image', 'status'];

//    public static function create(array $attributes = [])
//    {
//        debug($attributes);
//        if(!isset($attributes['image']))
//            $attributes['image'] = "asset-placeholder.png";
//        debug($attributes);
//
//        $model = new static($attributes);
//
//        $model->save();
//
//        return $model;
//    }

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

    /**
     * Get the Active Checkout for an asset.
     */
    public function activeCheckout()
    {
        return $this->hasOne('App\Models\Checkout')->whereNull('returned_date')->with('user');
    }

    /**
     * Get the Logs for an asset.
     */
    public function assetLogs()
    {
        return $this->hasMany('App\Models\AssetLogs')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get the Logs for an asset.
     */
    public function assetLogDates()
    {
        return $this->hasMany('App\Models\AssetLogs')
            ->orderBy('created_at', 'desc')
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at), DAY(created_at)'))
            ->select('asset_id', 'created_at');
    }

    /**
     * Get the location of the asset.
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }
}
