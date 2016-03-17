<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;

/**
 * Class User.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dealer[] $dealers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Checkout[] $checkouts
 * @property-read mixed $confirmed_label
 * @property-read mixed $picture
 * @property-read mixed $edit_button
 * @property-read mixed $change_password_button
 * @property-read mixed $status_button
 * @property-read mixed $confirmed_button
 * @property-read mixed $delete_button
 * @property-read mixed $action_buttons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Permission\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\SocialLogin[] $providers
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $status
 * @property string $confirmation_code
 * @property bool $confirmed
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class User extends Authenticatable
{
    use SoftDeletes, UserAccess, UserAttribute, UserRelationship;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the Dealers assigned to a User.
     */
    public function dealers()
    {
        return $this->hasMany('App\Models\Dealer');
    }

    /**
     * Get the Checkouts assigned to a User.
     */
    public function checkouts()
    {
        return $this->hasMany('App\Models\Checkout');
    }
}
