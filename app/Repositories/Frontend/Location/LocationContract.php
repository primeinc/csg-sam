<?php

namespace App\Repositories\Frontend\Location;

/**
 * Interface LocationContract.
 */
interface LocationContract
{
    /**
     * @param $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    public function findByName($name);

    public function findByNameAll($name);

    public function findOrCreate($nameOrId);
}
