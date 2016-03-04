<?php

namespace App\Repositories\Frontend\Dealer;

use App\Models\Dealer;

class EloquentDealerRepository implements DealerContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Dealer::findOrFail($id);
    }
}
