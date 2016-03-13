<?php

namespace App\Repositories\Frontend\Dealership;

/**
 * Interface DealershipContract
 * @package App\Repositories\Frontend\Dealership
 */
interface DealershipContract
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

    public function findOrCreate($name);

}
