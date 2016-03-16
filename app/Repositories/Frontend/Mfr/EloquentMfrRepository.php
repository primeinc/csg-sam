<?php
namespace App\Repositories\Frontend\Mfr;

use App\Models\Mfr;

class EloquentMfrRepository implements MfrContract
{
    /**
     * @param $name
     *
     * @return bool
     */
    public function findByNameAll($name)
    {
        $mfr = Mfr::where('name', 'LIKE', '%' . $name . '%')->get();

        return $mfr;
    }

    /**
     * @param $nameOrId
     *
     * @return EloquentMfrRepository
     */
    public function findOrCreate($nameOrId)
    {
        /**
         * Check to see if manufacturer exists already
         */
        if (!is_numeric($nameOrId)) {
            $mfr = $this->findByName($nameOrId);
        } else {
            $mfr = $this->find($nameOrId);
        }
        /**
         * If the Mfr does not exist create them
         */
        if (!$mfr) {
            $mfr = $this->create([
                'name' => $nameOrId,
            ]);
        }

        /**
         * Return the mfr object
         */
        return $mfr;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function findByName($name)
    {
        $mfr = Mfr::where('name', $name)->first();
        if ($mfr instanceof Mfr) {
            return $mfr;
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
        return Mfr::findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $mfr = Mfr::create([
            'name' => $data['name'],
        ]);

        return $mfr;
    }
}
