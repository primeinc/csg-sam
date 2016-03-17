<?php

namespace App\Repositories\Frontend\Dealer;

/**
 * Interface DealerContract.
 */
interface DealerContract
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email);

    public function destroy($id);
}
