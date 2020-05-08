<?php


namespace Modules\Permission\Actions;


use Lorisleiva\Actions\Action;
use Modules\Permission\Entities\Permission;

class GetParentPermissions extends Action
{
    public function handle()
    {
        $permission = Permission::active()->with('parent_members');

        if ($this->has('application')) {
            $permission = $permission->where('application_id', $this->application);
        }

        if ($this->has('resource_group')) {
            $permission = $permission->where('resource_group_id', $this->resource_group);
        }

        $result = $permission->where('parent_permission_id', null)->get();

        return $result;
    }
}
