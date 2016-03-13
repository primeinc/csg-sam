<?php

namespace App\Repositories\Frontend\Dealership;

use App\Models\Dealership;

class EloquentDealershipRepository implements DealershipContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $dealership = Dealership::create([
            'name' => $data['name'],
        ]);

        return $dealership;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Dealership::findOrFail($id);
    }

    /**
     * @param $name
     * @return bool
     */
    public function findByName($name) {
        $dealership = Dealership::where('name', $name)->first();

        if ($dealership instanceof Dealership)
            return $dealership;

        return false;
    }


    /**
     * @param $name
     * @return bool
     */
    public function findByNameAll($name) {
        $dealership = Dealership::where('name', 'LIKE', '%'.$name.'%')->get();

        return $dealership;

    }

    /**
     * @param $name
     * @return EloquentDealershipRepository
     */
    public function findOrCreate($name)
    {
        /**
         * Check to see if Dealership exists already
         */
        $dealership = $this->findByName($name);

        /**
         * If the Dealership does not exist create them
         */
        if (! $dealership) {
            $dealership = $this->create([
                'name'  => $name,
            ]);
        }


        /**
         * Return the Dealership object
         */
        return $dealership;

    }
}
