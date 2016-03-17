<?php

namespace App\Repositories\Frontend\AssetLogs;

use App\Models\AssetLogs;

class EloquentAssetLogRepository implements AssetLogsContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return AssetLogs::findOrFail($id);
    }
}
