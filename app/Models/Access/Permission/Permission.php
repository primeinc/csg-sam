<?php

namespace App\Models\Access\Permission;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;

/**
 * Class Permission.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @property-read \App\Models\Access\Permission\PermissionGroup $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Permission\PermissionDependency[] $dependencies
 * @property-read mixed $system_label
 * @property-read mixed $edit_button
 * @property-read mixed $delete_button
 * @property-read mixed $action_buttons
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property string $display_name
 * @property bool $system
 * @property int $sort
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Permission extends Model
{
    use PermissionRelationship, PermissionAttribute;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function __construct()
    {
        $this->table = config('access.permissions_table');
    }
}
