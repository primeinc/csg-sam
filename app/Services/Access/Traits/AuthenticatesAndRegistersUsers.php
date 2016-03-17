<?php

namespace App\Services\Access\Traits;

/**
 * Class AuthenticatesAndRegistersUsers.
 */
trait AuthenticatesAndRegistersUsers
{
    use AuthenticatesUsers, RegistersUsers {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    }
}
