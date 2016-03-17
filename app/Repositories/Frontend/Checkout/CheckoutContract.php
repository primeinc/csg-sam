<?php

namespace App\Repositories\Frontend\Checkout;

/**
 * Interface DealerContract.
 */
interface CheckoutContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);
}
