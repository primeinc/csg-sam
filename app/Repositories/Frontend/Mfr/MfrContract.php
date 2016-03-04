<?php

namespace App\Repositories\Frontend\Mfr;

/**
 * Interface MfrContract
 * @package App\Repositories\Frontend\Mfr
 */
interface MfrContract
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

    public function findOrCreate($name);

}
