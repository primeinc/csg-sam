<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class AssetLogs extends Model
{
    use SoftDeletes;

    protected $table = 'asset_logs';

    public function asset()
    {
        return $this->belongsTo('App\Models\Asset')->withTrashed();
    }

    public function checkout()
    {
        return $this->belongsTo('App\Models\Checkout');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User')->withTrashed();
    }

    public function getContextAttribute($value)
    {
        $context = json_decode($value);

        // TODO can we eagerload this?
        if (isset($context->location_id)) {
            $context->location_name = new stdClass();
            $context->location_name->new = Location::withTrashed()->find($context->location_id->new)->name;
            $context->location_name->old = Location::withTrashed()->find($context->location_id->old)->name;
        }

        if (isset($context->mfr_id)) {
            $context->manufacturer = new stdClass();
            $context->manufacturer->new = Mfr::withTrashed()->find($context->mfr_id->new)->name;
            $context->manufacturer->old = Mfr::withTrashed()->find($context->mfr_id->old)->name;
            unset($context->mfr_id);
        }

        return $context;
    }
}
