<?php

namespace App\Models\Access\Permission\Traits\Relationship;

/**
 * Class PermissionDependencyRelationship.
 */
trait PermissionDependencyRelationship
{
    /**
     * @return mixed
     */
    public function permission()
    {
        return $this->hasOne(config('access.permission'), 'id', 'dependency_id');
    }
}
