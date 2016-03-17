<?php

namespace App\Repositories\Frontend\Checkout;

use App\Models\Checkout;

class EloquentDealerRepository implements CheckoutContract
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
