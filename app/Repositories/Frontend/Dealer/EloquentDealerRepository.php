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

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email) {
        $dealer = Dealer::where('email', $email)->first();

        if ($dealer instanceof Dealer)
            return $dealer;

        return false;
    }
}
