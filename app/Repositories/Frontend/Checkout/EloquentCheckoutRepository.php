<?php

namespace App\Repositories\Frontend\Checkout;

use App\Models\Checkout;

class EloquentCheckoutRepository implements CheckoutContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Checkout::findOrFail($id);
    }
}
