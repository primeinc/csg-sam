<?php

namespace App\Repositories\Frontend\Asset;

use App\Models\Asset;

class EloquentAssetRepository implements AssetContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Asset::findOrFail($id);
    }
}
