<?php

namespace App\Models\Access\Permission\Traits\Relationship;

/**
 * Class PermissionGroupRelationship.
 */
trait PermissionGroupRelationship
{
    /**
     * @return mixed
     */
    public function children()
    {
        return $this->hasMany(config('access.group'), 'parent_id', 'id')->orderBy('sort', 'asc');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->hasMany(config('access.permission'), 'group_id')->orderBy('sort', 'asc');
    }
}
