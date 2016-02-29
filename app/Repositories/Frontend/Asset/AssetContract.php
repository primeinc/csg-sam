<?php

namespace App\Repositories\Frontend\Asset;

/**
 * Interface AssetContract
 * @package App\Repositories\Frontend\Asset
 */
interface AssetContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

}
