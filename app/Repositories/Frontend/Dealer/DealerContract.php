<?php

namespace App\Repositories\Frontend\Dealer;

/**
 * Interface DealerContract
 * @package App\Repositories\Frontend\Dealer
 */
interface DealerContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);

}
