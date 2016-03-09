<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetLogs extends Model
{
    use SoftDeletes;

    protected $table = 'asset_logs';


    public function asset()
    {
        return $this->belongsTo('App\Models\Asset');
    }

    public function checkout()
    {
        return $this->belongsTo('App\Models\Checkout');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

}
