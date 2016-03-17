<?php

namespace App\Repositories\Frontend\Dealer;

use App\Exceptions\GeneralException;
use App\Models\Checkout;
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
    public function findByEmail($email)
    {
        $dealer = Dealer::where('email', $email)->first();

        if ($dealer instanceof Dealer) {
            return $dealer;
        }

        return false;
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        $dealer = $this->find($id);

        $checkouts = Checkout::where('dealer_id', '=', $dealer->id)->where('returned_date', '=', null);

        if ($checkouts->count()) {
            throw new GeneralException($dealer->name.' still has active checkouts');
        }

        if ($dealer->delete()) {
            return true;
        }

        throw new GeneralException('Unknown Error deleting DSR');
    }
}
