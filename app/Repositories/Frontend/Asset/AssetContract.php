<?php

namespace App\Repositories\Frontend\Asset;

/**
 * Interface AssetContract.
 */
interface AssetContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);
}
