<?php

namespace App\Repositories\Frontend\Checkout;

/**
 * Interface DealerContract
 * @package App\Repositories\Frontend\Checkout
 */
interface CheckoutContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

}
