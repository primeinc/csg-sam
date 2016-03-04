<?php

namespace App\Repositories\Frontend\AssetLogs;

/**
 * Interface AssetLogsContract
 * @package App\Repositories\Frontend\AssetLogs
 */
interface AssetLogsContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

}
