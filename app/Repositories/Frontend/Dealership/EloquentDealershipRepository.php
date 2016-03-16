<?php
namespace App\Repositories\Frontend\Dealership;

use App\Models\Dealership;

class EloquentDealershipRepository implements DealershipContract
{
    /**
     * @param $name
     *
     * @return bool
     */
    public function findByNameAll($name)
    {
        $dealership = Dealership::where('name', 'LIKE', '%' . $name . '%')->get();

        return $dealership;
    }

    /**
     * @param $nameOrId
     *
     * @return EloquentDealershipRepository
     */
    public function findOrCreate($nameOrId)
    {
        /**
         * Check to see if Dealership exists already
         */
        if (!is_numeric($nameOrId)) {
            $dealership = $this->findByName($nameOrId);
        } else {
            $dealership = $this->find($nameOrId);
        }
        /**
         * If the Dealership does not exist create them
         */
        if (!$dealership) {
            $dealership = $this->create([
                'name' => $nameOrId,
            ]);
        }

        /**
         * Return the Dealership object
         */
        return $dealership;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function findByName($name)
    {
        $dealership = Dealership::where('name', $name)->first();
        if ($dealership instanceof Dealership) {
            return $dealership;
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
        return Dealership::findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $dealership = Dealership::create([
            'name' => $data['name'],
        ]);

        return $dealership;
    }
}
