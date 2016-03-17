<?php

namespace App\Repositories\Frontend\User;

/**
 * Interface UserContract.
 */
interface UserContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * @param $token
     * @return mixed
     */
    public function findByToken($token);

    /**
     * @param array $data
     * @param bool $provider
     * @return mixed
     */
    public function create(array $data, $provider = false);

    /**
     * @param $data
     * @param $provider
     * @return mixed
     */
    public function findOrCreateSocial($data, $provider);

    /**
     * @param $token
     * @return mixed
     */
    public function confirmAccount($token);

    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail($user);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function updateProfile($id, $input);

    /**
     * @param  $input
     * @return mixed
     */
    public function changePassword($input);
}
