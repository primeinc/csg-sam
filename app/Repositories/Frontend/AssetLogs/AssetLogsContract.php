<?php

namespace App\Repositories\Frontend\AssetLogs;

/**
 * Interface AssetLogsContract.
 */
interface AssetLogsContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);
}
