<?php
namespace App\Repositories\Frontend\Location;

use App\Models\Location;

class EloquentLocationRepository implements LocationContract
{
    /**
     * @param $name
     *
     * @return bool
     */
    public function findByNameAll($name)
    {
        $location = Location::where('name', 'LIKE', '%' . $name . '%')->get();

        return $location;
    }

    /**
     * @param $nameOrId
     *
     * @return EloquentLocationRepository
     */
    public function findOrCreate($nameOrId)
    {
        /**
         * Check to see if Location exists already
         */
        if (!is_numeric($nameOrId)) {
            $location = $this->findByName($nameOrId);
        } else {
            $location = $this->find($nameOrId);
        }
        /**
         * If the Location does not exist create them
         */
        if (!$location) {
            $location = $this->create([
                'name' => $nameOrId,
            ]);
        }

        /**
         * Return the Location object
         */
        return $location;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function findByName($name)
    {
        $location = Location::where('name', $name)->first();
        if ($location instanceof Location) {
            return $location;
        }

        return false;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return Location::findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $locations = Location::create([
            'name' => $data['name'],
        ]);

        return $locations;
    }
}
