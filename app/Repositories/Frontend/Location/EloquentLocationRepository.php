<?php

namespace App\Repositories\Frontend\Location;

use App\Models\Location;

class EloquentLocationRepository implements LocationContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $locations = Location::create([
            'name' => $data['name'],
        ]);

        return $locations;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Location::findOrFail($id);
    }

    /**
     * @param $name
     * @return bool
     */
    public function findByName($name) {
        $location = Location::where('name', $name)->first();

        if ($location instanceof Location)
            return $location;

        return false;
    }


    /**
     * @param $name
     * @return bool
     */
    public function findByNameAll($name) {
        $location = Location::where('name', 'LIKE', '%'.$name.'%')->get();

        return $location;

    }

    /**
     * @param $name
     * @return EloquentLocationRepository
     */
    public function findOrCreate($name)
    {
        /**
         * Check to see if Location exists already
         */
        $location = $this->findByName($name);

        /**
         * If the Location does not exist create them
         */
        if (! $location) {
            $location = $this->create([
                'name'  => $name,
            ]);
        }


        /**
         * Return the Location object
         */
        return $location;

    }
}
