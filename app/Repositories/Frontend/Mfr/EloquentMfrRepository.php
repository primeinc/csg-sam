<?php

namespace App\Repositories\Frontend\Mfr;

use App\Models\Mfr;

class EloquentMfrRepository implements MfrContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $mfr = Mfr::create([
            'name' => $data['name'],
        ]);

        return $mfr;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Mfr::findOrFail($id);
    }

    /**
     * @param $name
     * @return bool
     */
    public function findByName($name) {
        $mfr = Mfr::where('name', $name)->first();

        if ($mfr instanceof Mfr)
            return $mfr;

        return false;
    }


    /**
     * @param $name
     * @return bool
     */
    public function findByNameAll($name) {
        $mfr = Mfr::where('name', 'LIKE', '%'.$name.'%')->get();

        return $mfr;

    }

    /**
     * @param $name
     * @return EloquentMfrRepository
     */
    public function findOrCreate($name)
    {
        /**
         * Check to see if manufacturer exists already
         */
        $mfr = $this->findByName($name);

        /**
         * If the Mfr does not exist create them
         */
        if (! $mfr) {
            $mfr = $this->create([
                'name'  => $name,
            ]);
        }


        /**
         * Return the mfr object
         */
        return $mfr;

    }
}
